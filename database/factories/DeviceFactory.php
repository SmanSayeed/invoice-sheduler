<?php
namespace Database\Factories;

use App\Models\Client;
use App\Models\Device;
use Illuminate\Database\Eloquent\Factories\Factory;

class DeviceFactory extends Factory
{
    protected $model = Device::class;

    public function definition()
    {
        // Ensure client_id is between 1 and 10 (assuming clients are seeded sequentially)
        $clientId = $this->faker->numberBetween(1, 10);

        return [
            'client_id' => $clientId,
            'name' => $this->faker->word,
            'class' => $this->faker->randomElement(['security router', 'computer', 'server']),
            'unit_cost' => $this->faker->randomFloat(2, 5, 50),
        ];
    }
}
