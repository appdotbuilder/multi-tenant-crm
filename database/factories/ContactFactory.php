<?php

namespace Database\Factories;

use App\Models\Contact;
use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Contact>
 */
class ContactFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<\App\Models\Contact>
     */
    protected $model = Contact::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'email' => $this->faker->unique()->safeEmail(),
            'phone' => $this->faker->phoneNumber(),
            'mobile' => $this->faker->optional()->phoneNumber(),
            'job_title' => $this->faker->jobTitle(),
            'company_id' => null,
            'address' => $this->faker->optional()->address(),
            'birthday' => $this->faker->optional()->date(),
            'notes' => $this->faker->optional()->text(),
            'status' => $this->faker->randomElement(['active', 'inactive', 'lead']),
        ];
    }

    /**
     * Indicate that the contact is active.
     */
    public function active(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'active',
        ]);
    }

    /**
     * Indicate that the contact is a lead.
     */
    public function lead(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'lead',
        ]);
    }
}