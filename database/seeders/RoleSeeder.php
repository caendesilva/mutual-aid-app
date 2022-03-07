<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (!Role::where(['key' => 'admin'])->exists()) {
            Role::create([
                'key' => 'admin',
                'name' => 'Administrator'
            ]);
        }

        if (!Role::where(['key' => 'mod'])->exists()) {
            Role::create([
                'key' => 'mod',
                'name' => 'Moderator'
            ]);
        }

        if (!Role::where(['key' => 'map'])->exists()) {
            Role::create([
                'key' => 'map',
                'name' => 'Mutual Aid Provider'
            ]);
        }

        if (!Role::where(['key' => 'pin'])->exists()) {
            Role::create([
                'key' => 'pin',
                'name' => 'Person In Need'
            ]);
        }
        
        if (!Role::where(['key' => 'vol'])->exists()) {
            Role::create([
                'key' => 'vol',
                'name' => 'Volunteer'
            ]);
        }

        if (!Role::where(['key' => 'worker'])->exists()) {
            Role::create([
                'key' => 'worker',
                'name' => 'Worker'
            ]);
        }
    }
}
