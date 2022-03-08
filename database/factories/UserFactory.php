<?php

namespace Database\Factories;

use App\Models\Role;
use App\Models\Team;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Laravel\Jetstream\Features;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->getName(),
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => rand(0, 5) > 1 ? now() : null,
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),

            'created_at' => $this->faker->dateTimeBetween('-1month', 'now'),
            'phone' => rand(0, 3) > 1 ? $this->faker->e164PhoneNumber() : null,
            'area' => rand(0, 9) > 1 ? $this->faker->postcode() : null,
            'location' => $this->selectLocation(),
        ];
    }

    /**
     * Configure the model factory.
     *
     * @return $this
     */
    public function configure()
    {
        return $this->afterMaking(function (User $user) {
            //
        })->afterCreating(function (User $user) {
            $rand = rand(0, 10);
            if ($rand == 0) {
                return;
            } else if ($rand < 5) {
                $user->roles()->attach(Role::where(['key' => 'pin'])->first());
            } else if ($rand < 8) {
                $user->roles()->attach(Role::where(['key' => 'map'])->first());
            } else if ($rand < 10) {
                $user->roles()->attach(Role::where(['key' => 'pin'])->first());
                $user->roles()->attach(Role::where(['key' => 'map'])->first());
            }
            return;
        });
    }
 
    /**
     * As FakerPHP often gives names like Ms. Emmalee Greenholt IV,
     * we introduce some variation in the names by assembling
     * the first and last names ourselves, as well as just
     * using first names and nicknames.
     * 
     * @return string
     */
    public function getName(): string
    {
        $rand = rand(0, 12);
        if ($rand < 1) {
        return $this->faker->name();
    } elseif ($rand < 2) {
        return $this->faker->firstName() . ' ' . $this->faker->firstName() . ' ' . $this->faker->lastName();
        } elseif ($rand < 5) {
            return $this->faker->firstName() . ' ' . $this->faker->lastName();
       
       } elseif ($rand < 8) {
                return $this->faker->userName();
       } elseif ($rand < 9) {
            return $this->faker->firstName() . ' ' . strtoupper(Str::random(1)) . (rand(0, 2) == 1 ? '.' : '');
        } else {
            return $this->faker->firstName();
        }
    }

    /**
     * Return a location, selected pseudo-randomly between
     * different formats, lengths, and specificity.
     * 
     * @return string
     */
    public function selectLocation(): string
    {
        $rand = rand(0, 12);
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
        } else {
            return '';
        }
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }

    /**
     * Indicate that the user should have a personal team.
     *
     * @return $this
     */
    public function withPersonalTeam()
    {
        if (! Features::hasTeamFeatures()) {
            return $this->state([]);
        }

        return $this->has(
            Team::factory()
                ->state(function (array $attributes, User $user) {
                    return ['name' => $user->name.'\'s Team', 'user_id' => $user->id, 'personal_team' => true];
                }),
            'ownedTeams'
        );
    }
}
