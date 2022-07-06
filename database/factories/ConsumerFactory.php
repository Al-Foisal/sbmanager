<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ConsumerFactory extends Factory {
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition() {
        return [
            'shop_id' => 2,
            'name'    => $this->faker->name,
            'phone'    => rand(),
        ];
    }
}
