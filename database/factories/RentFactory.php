<?php

namespace Database\Factories;

use App\Models\Rent;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class RentFactory extends Factory
{
    protected $model = Rent::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'status' => $this->faker->randomElement([Rent::RENTED, Rent::RETURNED]),
            'rent_type' => $this->faker->randomElement([Rent::BOOKS, Rent::EQUIPMENT]),
        ];
    }
}
