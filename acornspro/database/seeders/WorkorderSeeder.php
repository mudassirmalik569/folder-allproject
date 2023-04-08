<?php

namespace Database\Seeders;

use App\Models\Workorder;
use App\Models\WorkorderItem;
use Illuminate\Database\Seeder;

class WorkorderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Workorder::factory(100)
            ->has(WorkorderItem::factory()->count(3), 'items')
            ->create();
    }
}
