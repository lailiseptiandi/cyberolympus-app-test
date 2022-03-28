<?php

namespace Database\Factories;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;

class CustomerFactory extends Factory
{
    protected $model = Customer::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nama' => $this->faker->name,
            'no_hp' => $this->faker->phoneNumber,
            'alamat' => $this->faker->address,
            'created_at' => $this->faker->dateTimeThisMonth,
        ];
    }
}
