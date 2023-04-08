<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkorderItem extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'item_id',
        'qty',
        'cost',
        'price',
        'type',
    ];

    /**
     * The workorder for the workorder item.
     */
    public function workorder()
    {
        return $this->belongsTo(Workorder::class);
    }

    /**
     * The item for the workorder.
     */
    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    /**
     * The payroll for the item.
     */
    public function payroll()
    {
        return $this->hasOne(Payroll::class);
    }
}
