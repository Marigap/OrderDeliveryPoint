<?php

namespace Database\Factories;

use App\Models\OrderInfo;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OrderInfo>
 */
class OrderInfoFactory extends Factory
{

    protected $model = OrderInfo::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'order_name' => $this->faker->word(),
            'weight' => $this->faker->randomFloat()
        ];
    }
}
