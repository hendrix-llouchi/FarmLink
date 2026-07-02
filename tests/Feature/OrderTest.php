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
            ]);

        $response->assertStatus(403);
        $this->assertEquals(10, $product->fresh()->quantity);
        $this->assertEquals(0, Order::count());
    }
}
