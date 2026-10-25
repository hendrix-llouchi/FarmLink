<?php

namespace Tests\Feature;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class LogisticsTest extends TestCase
{
    use RefreshDatabase;

    protected $driver;
    protected $buyer;
    protected $farmer;
    protected $product;
    protected $order;

    protected function setUp(): void
    {
        parent::setUp();

        // Create farmer
        $this->farmer = User::create([
            'name' => 'Kojo Farmer',
            'phone_number' => '0241112222',
            'password' => bcrypt('password'),
            'role' => 'farmer',
            'location' => 'Takoradi Market Circle',
        ]);

        // Create product
        $this->product = Product::create([
            'user_id' => $this->farmer->id,
            'name' => 'Garden Eggs',
            'category' => 'Vegetable',
            'quantity' => 50,
            'price' => 12.00,
        ]);

        // Create buyer
        $this->buyer = User::create([
            'name' => 'Ama Buyer',
            'phone_number' => '0243334444',
            'password' => bcrypt('password'),
            'role' => 'buyer',
            'location' => 'Tarkwa Gold Square',
        ]);

        // Create driver
        $this->driver = User::create([
            'name' => 'Kwame Driver',
            'phone_number' => '0245556666',
            'password' => bcrypt('password'),
            'role' => 'driver',
            'location' => 'Takoradi Station',
        ]);

        // Create a pending order
        $this->order = Order::create([
            'buyer_id'                 => $this->buyer->id,
            'product_id'               => $this->product->id,
            'quantity_ordered'          => 5,
            'total_price'              => 60.00,
            'status'                   => 'pending',
            'payment_status'           => 'escrow_held',
            'estimated_transport_cost' => 50.00,
        ]);
    }

    public function test_driver_can_view_dashboard_with_pending_deliveries()
    {
        $response = $this->actingAs($this->driver)
            ->get('/driver/dashboard');

        $response->assertStatus(200);
        $response->assertInertia(fn ($page) => $page
            ->component('DriverDashboard')
            ->has('orders', 1)
            ->where('orders.0.id', $this->order->id)
            ->where('orders.0.buyer.name', $this->buyer->name)
            ->where('orders.0.product.user.name', $this->farmer->name)
        );
    }

    public function test_driver_can_accept_delivery_successfully()
    {
        $response = $this->actingAs($this->driver)
            ->post("/driver/orders/{$this->order->id}/accept");

        $response->assertRedirect('/driver/dashboard');
        
        $this->order->refresh();
        $this->assertEquals($this->driver->id, $this->order->driver_id);
        $this->assertEquals('processing', $this->order->status);

        // Accepted delivery should no longer show on dashboard
        $checkResponse = $this->actingAs($this->driver)
            ->get('/driver/dashboard');
        
        $checkResponse->assertInertia(fn ($page) => $page
            ->component('DriverDashboard')
            ->has('orders', 0)
        );
    }

    public function test_driver_cannot_accept_already_assigned_delivery()
    {
        // First driver accepts
        $this->order->update([
            'driver_id' => $this->driver->id,
            'status' => 'processing',
        ]);

        // Create second driver
        $driver2 = User::create([
            'name' => 'Yaw Driver',
            'phone_number' => '0247778888',
            'password' => bcrypt('password'),
            'role' => 'driver',
            'location' => 'Tarkwa Station',
        ]);

        // Second driver tries to accept
        $response = $this->actingAs($driver2)
            ->from('/driver/dashboard')
            ->post("/driver/orders/{$this->order->id}/accept");

        // Should return to dashboard with session validation error
        $response->assertRedirect('/driver/dashboard');
        $response->assertSessionHasErrors('driver_id');
        
        // Assert first driver is still assigned
        $this->order->refresh();
        $this->assertEquals($this->driver->id, $this->order->driver_id);
    }

    public function test_non_driver_cannot_access_driver_dashboard()
    {
        // Buyer tries to access
        $response = $this->actingAs($this->buyer)
            ->get('/driver/dashboard');
        $response->assertStatus(403);
    }

    public function test_guest_cannot_access_driver_dashboard()
    {
        // Guest tries to access
        $guestResponse = $this->get('/driver/dashboard');
        $guestResponse->assertRedirect('/login');
    }

    public function test_non_driver_cannot_accept_delivery()
    {
        $response = $this->actingAs($this->buyer)
            ->post("/driver/orders/{$this->order->id}/accept");

        $response->assertStatus(403);
        $this->order->refresh();
        $this->assertNull($this->order->driver_id);
    }

    public function test_driver_cannot_move_unverified_order_into_transit()
    {
        $this->order->update([
            'driver_id' => $this->driver->id,
            'status' => 'processing',
        ]);

        $response = $this->actingAs($this->driver)
            ->post("/driver/orders/{$this->order->id}/pickup");

        $response->assertSessionHasErrors('status');
        $this->order->refresh();
        $this->assertEquals('processing', $this->order->status);
        $this->assertEquals('escrow_held', $this->order->payment_status);
    }

    public function test_driver_arrival_requires_a_photo_and_does_not_release_escrow()
    {
        $this->order->update([
            'driver_id' => $this->driver->id,
            'status' => 'in_transit',
            'handover_confirmed_at' => now(),
        ]);

        $this->order->verification()->create([
            'driver_id' => $this->driver->id,
            'claimed_quantity' => $this->order->quantity_ordered,
            'actual_quantity' => $this->order->quantity_ordered,
            'claimed_grade' => null,
            'actual_grade' => 'A',
            'grade_match' => true,
            'freshness_match' => true,
            'damage_note' => null,
            'heavy_spoilage' => false,
            'packaging_ok' => true,
            'pickup_photos' => ['pickup-wide.jpg', 'pickup-close.jpg'],
            'outcome' => 'verified',
        ]);

        $response = $this->actingAs($this->driver)
            ->post("/driver/orders/{$this->order->id}/complete");

        $response->assertSessionHasErrors('delivery_photo');
        $this->order->refresh();
        $this->assertEquals('in_transit', $this->order->status);
        $this->assertEquals('escrow_held', $this->order->payment_status);
    }

    public function test_buyer_confirmation_is_required_to_release_escrow()
    {
        $this->order->update([
            'driver_id' => $this->driver->id,
            'status' => 'in_transit',
            'workflow_status' => 'arrived',
            'delivery_photo_path' => 'verifications/delivery/arrived.jpg',
            'arrived_at' => now(),
        ]);
        $this->order->verification()->create([
            'driver_id' => $this->driver->id,
            'claimed_quantity' => $this->order->quantity_ordered,
            'actual_quantity' => $this->order->quantity_ordered,
            'claimed_grade' => null,
            'actual_grade' => 'A',
            'grade_match' => true,
            'freshness_match' => true,
            'damage_note' => null,
            'heavy_spoilage' => false,
            'packaging_ok' => true,
            'pickup_photos' => ['pickup-wide.jpg', 'pickup-close.jpg'],
            'outcome' => 'verified',
        ]);

        $response = $this->actingAs($this->buyer)
            ->post("/buyer/orders/{$this->order->id}/confirm-received");

        $response->assertRedirect();
        $this->order->refresh();
        $this->assertEquals('delivered', $this->order->status);
        $this->assertEquals('delivered', $this->order->workflow_status);
        $this->assertEquals('released', $this->order->payment_status);
        $this->assertNotNull($this->order->buyer_confirmed_at);
    }

    public function test_non_assigned_driver_cannot_complete_delivery()
    {
        // Assigned to first driver
        $this->order->update([
            'driver_id' => $this->driver->id,
            'status' => 'processing',
        ]);

        // Create another driver
        $driver2 = User::create([
            'name' => 'Yaw Driver',
            'phone_number' => '0247778888',
            'password' => bcrypt('password'),
            'role' => 'driver',
            'location' => 'Tarkwa Station',
        ]);

        $response = $this->actingAs($driver2)
            ->post("/driver/orders/{$this->order->id}/complete", [
                'delivery_photo' => UploadedFile::fake()->create('arrival.jpg', 1, 'image/jpeg'),
            ]);

        $response->assertSessionHasErrors('order');
        
        $this->order->refresh();
        $this->assertEquals('processing', $this->order->status);
    }
}
