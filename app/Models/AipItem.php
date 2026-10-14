<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AipItem extends Model
{
    protected $fillable = ['equipment_name', 'serial_number', 'brand', 'model', 'status'];
}