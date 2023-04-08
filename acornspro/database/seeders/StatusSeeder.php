<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $defaultStatuses = [
            'Open',
            'Invoice',
            'Pending',
            'Completed',
            'PO Paid',
            'Needs Quote',
            'Cancelled',
        ];

        foreach ($defaultStatuses as $df) {
            Status::firstOrCreate([
                'name' => $df,
            ]);
        }
    }
}
