<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InventoryItem extends Model
{
    protected $fillable = ['classroom_id', 'objeto', 'cantidad', 'condicion'];

    public function classroom()
    {
        return $this->belongsTo(Classroom::class);
    }
}