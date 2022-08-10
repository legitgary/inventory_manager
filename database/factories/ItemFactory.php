<?php

namespace Database\Factories;

use App\Models\Store;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Item>
 */
class ItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $stores = Store::pluck('id')->toArray();

        return [
            'store_id' => $this->faker->randomElement($stores),
            'full_name' => $this->faker->catchPhrase(),
            'item_code' => strtoupper($this->faker->bothify('EG####???')),
            'quantity' => $this->faker->numberBetween(0, 10),
            'purchase_price' => $this->faker->randomFloat(2, 1, 1000),
            'markup' => $this->faker->numberBetween(0, 200)
        ];
    }
}
