<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DemoSeeder extends Seeder
{
    /**
     * Run the database seeds to populate it with demo data.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(12)->create();
        $this->call([
            RequestSeeder::class,
            OfferSeeder::class,
        ]);
    }
}
