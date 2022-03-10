<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Listing>
 */
class ListingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $type = rand(1, 3) == 1 ? 'offer' : 'request';

        return [
            'type' => $type,
            'user_id' => User::all()->random()->id,
            'subject' => substr($this->faker->sentence(), 0, 64),
            'body' => $this->faker->sentences(rand(1, rand(6, 8)), asText: true),
            'contacts' => $this->selectContacts($type),
            'location' => $this->selectLocation(),
            'resources' => $this->selectResources(),
            'created_at' => $this->faker->dateTimeBetween('-1month', 'now'),
            'metadata' => $this->getMetadata(),
        ];
    }

    /**
     * Return some contact information.
     * 
     * @return string
     */
    public function selectContacts(string $type): string
    {
        $string = "";

        if (rand(0, 3) < 1) {
            $string .= rand(0, 1) == 0 ? $this->faker->phoneNumber() : $this->faker->e164PhoneNumber();
            $string .= PHP_EOL;
        } 
        if (rand(0, 3) < 1) {
            $string .= $this->faker->safeEmail();
            $string .= PHP_EOL;
        } 
        if ($type === 'offer' && rand(0, 7) < 1) {
            if (rand(0, 3) < 1) {
                $string .= $this->faker->url();
            } else {
                $string .= $this->faker->domainName();
            }
            $string .= PHP_EOL;
        } 

        return $string;
    }

     /**
     * Return some metadata.
     * 
     * @return object
     */
    public function getMetadata()
    {
        // @todo implement getMetadata()
        return null;
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
