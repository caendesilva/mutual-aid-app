<?php

namespace App\Http\Livewire;

use App\Models\Role;
use App\Models\User;
use Auth;
use Livewire\Component;

class RoleSelector extends Component
{
    protected $rules = [
        'roles' => ['nullable', 'string', 'in:pin,map,both'],
    ];

    public string $roles = "";

    public function mount()
    {
        if (Auth::user()->hasRole('pin') && Auth::user()->hasRole('map')) {
            $this->roles = "both";
        } elseif (Auth::user()->hasRole('pin')) {
            $this->roles = "pin";
        } elseif (Auth::user()->hasRole('map')) {
            $this->roles = "map";
        } else {
            $this->roles = "";
        }
    }

    public function updateRoles()
    {
        // We attach the roles this way to be sure only whitelisted roles can be added.
        $selected = $this->roles;
        if ($selected == 'pin') {
            if (!Auth::user()->hasRole('pin')) {
                Auth::user()->roles()->attach(Role::where(['key' => 'pin'])->first());
            }
            Auth::user()->roles()->detach(Role::where(['key' => 'map'])->first());
        } elseif ($selected == 'map') {
            if (!Auth::user()->hasRole('map')) {
                Auth::user()->roles()->attach(Role::where(['key' => 'map'])->first());
            }
            Auth::user()->roles()->detach(Role::where(['key' => 'pin'])->first());
        } elseif ($selected == 'both') {
            if (!Auth::user()->hasRole('pin')) {
                Auth::user()->roles()->attach(Role::where(['key' => 'pin'])->first());
            }
            if (!Auth::user()->hasRole('map')) {
                Auth::user()->roles()->attach(Role::where(['key' => 'map'])->first());
            }
        } elseif ($selected == '') {
            Auth::user()->roles()->detach(Role::where(['key' => 'pin'])->first());
            Auth::user()->roles()->detach(Role::where(['key' => 'map'])->first());
        } else {
            abort(400, 'Invalid role');
        }

        Auth::user()->save();
        $this->emit('saved');
    }

    public function render()
    {
        return view('profile.role-selector-form');
    }
}
