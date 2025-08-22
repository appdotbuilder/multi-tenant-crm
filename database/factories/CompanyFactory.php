<?php

namespace Database\Factories;

use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Company>
 */
class CompanyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<\App\Models\Company>
     */
    protected $model = Company::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->company(),
            'email' => $this->faker->unique()->companyEmail(),
            'phone' => $this->faker->phoneNumber(),
            'website' => $this->faker->url(),
            'address' => $this->faker->address(),
            'industry' => $this->faker->randomElement([
                'Technology', 'Healthcare', 'Finance', 'Manufacturing', 
                'Retail', 'Education', 'Real Estate', 'Consulting'
            ]),
            'employee_count' => $this->faker->numberBetween(1, 10000),
            'annual_revenue' => $this->faker->randomFloat(2, 100000, 50000000),
            'notes' => $this->faker->optional()->text(),
            'status' => $this->faker->randomElement(['active', 'inactive', 'prospect']),
        ];
    }

    /**
     * Indicate that the company is active.
     */
    public function active(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'active',
        ]);
    }

    /**
     * Indicate that the company is a prospect.
     */
    public function prospect(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'prospect',
        ]);
    }
}