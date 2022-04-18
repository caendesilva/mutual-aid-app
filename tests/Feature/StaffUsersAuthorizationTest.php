<?php

namespace Tests\Feature;

use App\Models\Role;
use App\Models\User;
use Database\Seeders\RoleSeeder;
use Tests\TestCase;
use Livewire\Livewire;
use Laravel\Jetstream\Http\Livewire\TwoFactorAuthenticationForm;


class StaffUsersAuthorizationTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        $this->seed(RoleSeeder::class);
    }

    public function test_dashboard_requires_authentication()
    {
        $this->get('/dashboard')->assertRedirect('/login');
    }

    public function test_standard_user_cannot_access_dashboard()
    {
        $this->actingAs($user = User::factory()->create());

        // Assert the user is forbidden from accessing the dashboard
        $this->get('/dashboard')->assertForbidden();
    }

    public function test_staff_user_cannot_access_dashboard_with_unverified_email()
    {
        $user = User::factory()->create([
            'email_verified_at' => null,
        ]);

        $user->roles()->attach(Role::where('key', 'vol')->firstOrFail());

        $this->actingAs($user);

        $this->get('/dashboard')->assertRedirect('/email/verify');
    }

    public function test_verified_staff_user_cannot_access_dashboard_without_2fa()
    {
        $user = User::factory()->create([
            'email_verified_at' => now(),
        ]);

        $user->roles()->attach(Role::where('key', 'vol')->firstOrFail());

        $this->actingAs($user);

        $this->get('/dashboard')->assertRedirect('/user/profile');
    }

    public function test_verified_staff_user_can_access_dashboard_with_2fa()
    {
        $user = User::factory()->create([
            'email_verified_at' => now(),
        ]);

        $user->roles()->attach(Role::where('key', 'vol')->firstOrFail());

        $this->actingAs($user);

        $this->withSession(['auth.password_confirmed_at' => time()]);

        Livewire::test(TwoFactorAuthenticationForm::class)
                ->call('enableTwoFactorAuthentication');

        $user = $user->fresh();

        $this->get('/dashboard')->assertOk();
    }
}
