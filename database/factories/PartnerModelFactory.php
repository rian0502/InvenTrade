<?php

namespace Database\Factories;

use App\Helper\CodeGenerator;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PartnerModel>
 */
class PartnerModelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'code' => $this->faker->unique()->iban('V', 'ID'),
            'name' => $this->faker->company(),
            'npwp' => $this->faker->unique()->numerify('##.###.###.#-###.###'),
            'description' => $this->faker->sentence(),
            'email' => $this->faker->unique()->companyEmail(),
            'phone' => $this->faker->e164PhoneNumber(),
            'contact_person' => $this->faker->phoneNumber(),
            'address' => $this->faker->address(),
            'is_supplier' => 1,
            'is_active' => 1,
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ];
    }
}
