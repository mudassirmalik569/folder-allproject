<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payroll extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'po',
        'name',
        'cost',
    ];

    /**
     * Get the workorder item for the payroll.
     */
    public function workorderItem()
    {
        return $this->belongsTo(WorkorderItem::class);
    }
}
