<?php

namespace Database\Factories;

use App\Models\Client;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class ClientFactory extends Factory
{
    protected $model = Client::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'address' => $this->faker->address,
            'phone' => $this->faker->phoneNumber,
            'payment_due_date' => Carbon::now()->addDays(rand(10, 30)),
            'per_day_per_device_cost' => $this->faker->randomFloat(2, 10, 100),
            'vat_slab' => $this->faker->randomElement(['Standard', 'Reduced', 'Zero']),
            'gbs_info' => $this->faker->sentence,
            'discount_eligibility' => $this->faker->boolean,
            'valuable_client_status' => $this->faker->boolean,
        ];
    }
}
