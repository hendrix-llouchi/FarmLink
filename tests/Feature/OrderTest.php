<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\User;
use App\Models\Order;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class OrderTest extends TestCase
{
    use RefreshDatabase;

    public function test_buyer_can_place_order_successfully()
    {
        // Create a farmer user
        $farmer = User::create([
            'name' => 'John Farmer',
            'phone_number' => '0241112222',
            'password' => bcrypt('password'),
            'role' => 'farmer',
            'location' => 'Takoradi',
        ]);

        // Create a product
        $product = Product::create([
            'user_id' => $farmer->id,
            'name' => 'Fresh Tomatoes',
            'category' => 'Vegetable',
            'quantity' => 100,
            'price' => 5.50,
        ]);

        // Create a buyer user
        $buyer = User::create([
            'name' => 'Alice Buyer',
            'phone_number' => '0243334444',
            'password' => bcrypt('password'),
            'role' => 'buyer',
            'location' => 'Tarkwa',
        ]);

        // Act as buyer
        $response = $this->actingAs($buyer)
            ->post('/buyer/orders', [
                'product_id' => $product->id,
                'quantity_ordered' => 20,
                'payment_network' => 'MTN',
                'payment_number' => '0541112222',
                'payment_pin' => '1234',
            ]);

        // Check redirect to index
        $response->assertRedirect('/buyer/orders');

        // Check product stock decremented
        $this->assertEquals(80, $product->fresh()->quantity);

        // Check order saved
        $this->assertDatabaseHas('orders', [
            'buyer_id' => $buyer->id,
            'product_id' => $product->id,
            'quantity_ordered' => 20,
            'total_price' => 110.00,
            'status' => 'pending',
            'payment_status' => 'escrow_held',
        ]);
    }

    public function test_cannot_order_exceeding_stock()
    {
        $farmer = User::create([
            'name' => 'John Farmer',
            'phone_number' => '0241112222',
            'password' => bcrypt('password'),
            'role' => 'farmer',
            'location' => 'Takoradi',
        ]);

        $product = Product::create([
            'user_id' => $farmer->id,
            'name' => 'Fresh Tomatoes',
            'category' => 'Vegetable',
            'quantity' => 10,
            'price' => 5.50,
        ]);

        $buyer = User::create([
            'name' => 'Alice Buyer',
            'phone_number' => '0243334444',
            'password' => bcrypt('password'),
            'role' => 'buyer',
            'location' => 'Tarkwa',
        ]);

        $response = $this->actingAs($buyer)
            ->from('/buyer/browse')
            ->post('/buyer/orders', [
                'product_id' => $product->id,
                'quantity_ordered' => 11,
                'payment_network' => 'MTN',
                'payment_number' => '0541112222',
                'payment_pin' => '1234',
            ]);

        // Should redirect back to /buyer/browse
        $response->assertRedirect('/buyer/browse');
        $response->assertSessionHasErrors('quantity_ordered');

        // Check stock did not change
        $this->assertEquals(10, $product->fresh()->quantity);

        // Check no order created
        $this->assertEquals(0, Order::count());
    }

    public function test_non_buyer_cannot_place_order()
    {
        $farmer = User::create([
            'name' => 'John Farmer',
            'phone_number' => '0241112222',
            'password' => bcrypt('password'),
            'role' => 'farmer',
            'location' => 'Takoradi',
        ]);

        $product = Product::create([
            'user_id' => $farmer->id,
            'name' => 'Fresh Tomatoes',
            'category' => 'Vegetable',
            'quantity' => 10,
            'price' => 5.50,
        ]);

        // Act as farmer (who is NOT a buyer)
        $response = $this->actingAs($farmer)
            ->post('/buyer/orders', [
                'product_id' => $product->id,
                'quantity_ordered' => 2,
                'payment_network' => 'MTN',
                'payment_number' => '0541112222',
                'payment_pin' => '1234',
            ]);

        $response->assertStatus(403);
        $this->assertEquals(10, $product->fresh()->quantity);
        $this->assertEquals(0, Order::count());
    }

    public function test_buyer_can_rate_delivered_order_successfully()
    {
        $farmer = User::create([
            'name' => 'John Farmer',
            'phone_number' => '0241112222',
            'password' => bcrypt('password'),
            'role' => 'farmer',
            'location' => 'Takoradi',
        ]);

        $product = Product::create([
            'user_id' => $farmer->id,
            'name' => 'Fresh Tomatoes',
            'category' => 'Vegetable',
            'quantity' => 10,
            'price' => 5.50,
        ]);

        $buyer = User::create([
            'name' => 'Alice Buyer',
            'phone_number' => '0243334444',
            'password' => bcrypt('password'),
            'role' => 'buyer',
            'location' => 'Tarkwa',
        ]);

        $order = Order::create([
            'buyer_id' => $buyer->id,
            'product_id' => $product->id,
            'quantity_ordered' => 2,
            'total_price' => 11.00,
            'status' => 'delivered',
        ]);

        $response = $this->actingAs($buyer)
            ->post("/buyer/orders/{$order->id}/rate", [
                'score' => 4,
                'comment' => 'Very good produce!',
            ]);

        $response->assertRedirect();
        
        $this->assertDatabaseHas('ratings', [
            'order_id' => $order->id,
            'rater_id' => $buyer->id,
            'ratee_id' => $farmer->id,
            'score' => 4,
            'comment' => 'Very good produce!',
        ]);

        // Check farmer's average rating recalculated
        $farmer->refresh();
        $this->assertEquals(4.00, (float) $farmer->average_rating);
    }

    public function test_rating_updates_farmer_average_rating()
    {
        $farmer = User::create([
            'name' => 'John Farmer',
            'phone_number' => '0241112222',
            'password' => bcrypt('password'),
            'role' => 'farmer',
            'location' => 'Takoradi',
        ]);

        $product = Product::create([
            'user_id' => $farmer->id,
            'name' => 'Fresh Tomatoes',
            'category' => 'Vegetable',
            'quantity' => 10,
            'price' => 5.50,
        ]);

        $buyer1 = User::create([
            'name' => 'Alice Buyer',
            'phone_number' => '0243334444',
            'password' => bcrypt('password'),
            'role' => 'buyer',
            'location' => 'Tarkwa',
        ]);

        $buyer2 = User::create([
            'name' => 'Bob Buyer',
            'phone_number' => '0245556666',
            'password' => bcrypt('password'),
            'role' => 'buyer',
            'location' => 'Tarkwa',
        ]);

        $order1 = Order::create([
            'buyer_id' => $buyer1->id,
            'product_id' => $product->id,
            'quantity_ordered' => 2,
            'total_price' => 11.00,
            'status' => 'delivered',
        ]);

        $order2 = Order::create([
            'buyer_id' => $buyer2->id,
            'product_id' => $product->id,
            'quantity_ordered' => 3,
            'total_price' => 16.50,
            'status' => 'delivered',
        ]);

        // Rate 1: 5 stars
        $this->actingAs($buyer1)->post("/buyer/orders/{$order1->id}/rate", [
            'score' => 5,
        ]);

        // Rate 2: 3 stars
        $this->actingAs($buyer2)->post("/buyer/orders/{$order2->id}/rate", [
            'score' => 3,
        ]);

        // Farmer's average rating should be (5 + 3) / 2 = 4.00
        $farmer->refresh();
        $this->assertEquals(4.00, (float) $farmer->average_rating);
    }
}
