<?php

namespace App\Observers;

use App\Models\WorkorderStatus;

class WorkorderStatusObserver
{
    /**
     * Handle the WorkorderStatus "saved" event.
     *
     * @param  \App\Models\WorkorderStatus  $workorderStatus
     * @return void
     */
    public function saved(WorkorderStatus $workorderStatus)
    {
        $workorderStatus->updateParentStatus();
    }

    /**
     * Handle the WorkorderStatus "deleted" event.
     *
     * @param  \App\Models\WorkorderStatus  $workorderStatus
     * @return void
     */
    public function deleted(WorkorderStatus $workorderStatus)
    {
        $workorderStatus->updateParentStatus();
    }
}
