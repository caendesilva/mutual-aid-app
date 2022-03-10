<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @deprecated
 * @extends \Illuminate\Database\Eloquent\Factories\Factory
 */
class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id' => User::all()->random()->id,
            'subject' => substr($this->faker->sentence(), 0, 64),
            'body' => $this->faker->sentences(rand(1, rand(6, 8)), asText: true),
            'location' => $this->selectLocation(),
            'resources' => $this->selectResources(),
            'created_at' => $this->faker->dateTimeBetween('-1month', 'now'),
            'expires_at' => $this->faker->dateTimeBetween('now', '+1month'),
			$this->religiousAttribute => rand(0, rand(0, 1)),
        ];
    }

    /**
     * Return a location, selected pseudo-randomly between
     * different formats, lengths, and specificity.
     * 
     * @return string
     */
    public function selectLocation(): string
    {
        $rand = rand(0, 9);
        if ($rand < 1) {
            return $this->faker->address();
        } elseif ($rand < 2) {
            return $this->faker->streetAddress();
        } elseif ($rand < 3) {
            return $this->faker->state();
        } elseif ($rand < 4) {
            return $this->faker->city();
        } elseif ($rand < 5) {
            return $this->faker->city() .', '. $this->faker->state();
        } elseif ($rand < 6) {
            return $this->faker->postcode();
        } elseif ($rand < 9) {
            return $this->faker->postcode() .', '. $this->faker->state();
        } else {
            return '';
        }
    }

    /**
     * Select a few pseudo-random resources.
     * 
     * Uses a basic algorithm to weight the resource amount.
     * @return array
     */
    private function selectResources(): array
    {
        $availableResourceCategories = ['water', 'food', 'money', 'shelter', 'other'];
        
        $resourcesToAdd = rand(rand(rand(0, 1), 2), rand(2, rand(4, 5)));
        return $resourcesToAdd ? (array) array_rand(array_flip($availableResourceCategories), $resourcesToAdd) : [];
    }
}
