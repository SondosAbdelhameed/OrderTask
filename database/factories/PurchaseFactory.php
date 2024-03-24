<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Product;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class PurchaseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $users = User::all()->pluck('id');
        $product_id = fake()->randomElement(Product::all()->pluck('id'));
        $quantity = fake()->numberBetween(0,10);
        $product = Product::find($product_id);
        $cost = $product->price * $quantity;
        return [
            'user_id' => fake()->randomElement($users),
            'product_id' => $product_id,
            'quantity' => $quantity,
            'total_cost' => $cost
        ];
    }
}
