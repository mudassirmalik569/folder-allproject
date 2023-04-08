<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WorkorderStatus extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'note',
    ];

    /**
     * The workorder for the status.
     */
    public function workorder(): BelongsTo
    {
        return $this->belongsTo(Workorder::class);
    }

    /**
     * Updates the workorder's current status.
     */
    public function updateParentStatus(): void
    {
        $workorder = $this->workorder;
        $status = $workorder->statuses()->latest()->get()[0]->name;
        $workorder->status = $status;
        $workorder->saveQuietly();
    }
}
