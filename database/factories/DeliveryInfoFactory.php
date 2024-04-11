<?php

namespace Database\Factories;

use App\Models\OrderInfo;
use App\Models\DeliveryInfo;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DeliveryInfo>
 */
class DeliveryInfoFactory extends Factory
{
    protected $model = DeliveryInfo::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'status' => $this->faker->randomElement(['accepted', 'processing', 'in_transit', 'delivered', 'picked_up']),
            'current_location' => $this->faker->city(),
            'need_notify' => $this->faker->boolean(),
        ];
    }
}
