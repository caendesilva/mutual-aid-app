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
        if (!Role::where(['key' => 'admin'])) {
            Role::create([
                'key' => 'admin',
                'name' => 'Administrator'
            ]);
        }

        if (!Role::where(['key' => 'mod'])) {
            Role::create([
                'key' => 'mod',
                'name' => 'Moderator'
            ]);
        }

        if (!Role::where(['key' => 'map'])) {
            Role::create([
                'key' => 'map',
                'name' => 'Mutual Aid Provider'
            ]);
        }

        if (!Role::where(['key' => 'pin'])) {
            Role::create([
                'key' => 'pin',
                'name' => 'Person In Need'
            ]);
        }
        
        if (!Role::where(['key' => 'vol'])) {
            Role::create([
                'key' => 'pin',
                'name' => 'Volunteer'
            ]);
        }

        if (!Role::where(['key' => 'worker'])) {
            Role::create([
                'key' => 'worker',
                'name' => 'Worker'
            ]);
        }
    }
}
