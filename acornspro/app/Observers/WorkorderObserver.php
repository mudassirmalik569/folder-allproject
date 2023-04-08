<?php

namespace App\Observers;

use App\Models\Workorder;

class WorkorderObserver
{
    /**
     * Handle the Workorder "created" event.
     *
     * @param  \App\Models\Workorder  $workorder
     * @return void
     */
    public function created(Workorder $workorder)
    {
        $workorder->statuses()->create(['name' => 'Open']);
    }

    /**
     * Handle the Workorder "updated" event.
     *
     * @param  \App\Models\Workorder  $workorder
     * @return void
     */
    public function updated(Workorder $workorder)
    {
        if ($workorder->payout > 0) {
            $workorder->statuses()->create(['name' => 'PO Paid']);
            foreach ($workorder->items as $item) {
                if ($item->type == 'labor') {
                    $p = $item->payroll()->firstOrNew();
                    $p->po = $workorder->po;
                    $p->name = $item->item->name;
                    $p->cost = $item->cost * $item->qty;
                    $p->save();
                }
            }
        }
    }
}
