<?php

namespace App\Actions\Fortify;

use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;
use Illuminate\Validation\Rule;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        /**
         * Some of the fields are implemented but have been commented out
         * as to not clutter the registration form. They can all be set
         * and updated on the account settings page.
         */
        Validator::make($input, [
            'name'  => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            // 'phone' => ['nullable', 'string', 'max:16', 'unique:users'],
            'area'  => ['nullable', 'string', 'max:12'],
            // 'location' => ['nullable', 'string', 'max:128'],
            'roles' => ['nullable', 'string', Rule::in(['pin', 'map', 'both'])],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->validate();

        $user = User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            // 'phone' => $input['phone'] ?? '',
            'area' => $input['area'] ?? '',
            // 'location' => $input['location'] ?? '',
            'password' => Hash::make($input['password']),
        ]);

        try {
            if (isset($input['roles'])) {
                // We attach the roles this way to be sure only whitelisted roles can be added.
                switch ($input['roles']) {
                    case 'pin':
                        $user->roles()->attach(Role::where(['key' => 'pin'])->first());
                        break;
                    case 'map':
                        $user->roles()->attach(Role::where(['key' => 'map'])->first());
                        break;
                    case 'both':
                        $user->roles()->attach(Role::where(['key' => 'pin'])->first());
                        $user->roles()->attach(Role::where(['key' => 'map'])->first());
                        break;
                    default:
                        # code...
                        break;
                }
                $user->save();
            }
        } catch (\Throwable $th) {
            // We want to handle failures with roles gracefully as it is not critical for registration.
            request()->session()->flash(
                'flash.banner',
                __('Something wen\'t wrong when setting your roles. You can update them on your account page.')
            );
        }

        return $user;
    }
}
