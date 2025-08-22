<?php

namespace Database\Factories;

use App\Models\Lead;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Lead>
 */
class LeadFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<\App\Models\Lead>
     */
    protected $model = Lead::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(3),
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'email' => $this->faker->unique()->safeEmail(),
            'phone' => $this->faker->optional()->phoneNumber(),
            'company' => $this->faker->optional()->company(),
            'job_title' => $this->faker->optional()->jobTitle(),
            'source' => $this->faker->randomElement([
                'website', 'referral', 'social_media', 'cold_call', 'email_campaign', 'other'
            ]),
            'status' => $this->faker->randomElement([
                'new', 'contacted', 'qualified', 'proposal', 'negotiation', 'won', 'lost'
            ]),
            'estimated_value' => $this->faker->optional()->randomFloat(2, 1000, 100000),
            'notes' => $this->faker->optional()->text(),
            'assigned_to' => null,
        ];
    }

    /**
     * Indicate that the lead is new.
     */
    public function newLead(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'new',
        ]);
    }

    /**
     * Indicate that the lead is qualified.
     */
    public function qualified(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'qualified',
        ]);
    }
}