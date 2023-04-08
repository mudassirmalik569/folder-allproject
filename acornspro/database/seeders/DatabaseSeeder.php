<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory()->create([
            'email' => 'admin@acornspro.com',
        ]);

        \App\Models\Item::factory(10)->create();

        $this->call([
            StatusSeeder::class,
            WorkorderSeeder::class,
        ]);
    }
}
