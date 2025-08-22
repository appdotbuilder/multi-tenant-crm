<?php

namespace Database\Factories;

use App\Models\Deal;
use App\Models\Company;
use App\Models\Contact;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Deal>
 */
class DealFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<\App\Models\Deal>
     */
    protected $model = Deal::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $stages = ['prospecting', 'qualification', 'proposal', 'negotiation', 'closed_won', 'closed_lost'];
        $stage = $this->faker->randomElement($stages);
        
        // Set probability based on stage
        $probability = match($stage) {
            'prospecting' => random_int(5, 20),
            'qualification' => random_int(15, 35),
            'proposal' => random_int(30, 60),
            'negotiation' => random_int(60, 85),
            'closed_won' => 100,
            'closed_lost' => 0,
            default => random_int(10, 50)
        };

        return [
            'name' => $this->faker->sentence(3),
            'value' => $this->faker->randomFloat(2, 5000, 500000),
            'company_id' => null,
            'contact_id' => null,
            'stage' => $stage,
            'probability' => $probability,
            'expected_close_date' => $this->faker->dateTimeBetween('now', '+6 months'),
            'description' => $this->faker->optional()->paragraph(),
            'assigned_to' => null,
        ];
    }

    /**
     * Indicate that the deal is in prospecting stage.
     */
    public function prospecting(): static
    {
        return $this->state(fn (array $attributes) => [
            'stage' => 'prospecting',
            'probability' => random_int(5, 20),
        ]);
    }

    /**
     * Indicate that the deal is closed won.
     */
    public function closedWon(): static
    {
        return $this->state(fn (array $attributes) => [
            'stage' => 'closed_won',
            'probability' => 100,
            'expected_close_date' => $this->faker->dateTimeBetween('-3 months', 'now'),
        ]);
    }
}