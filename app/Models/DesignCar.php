<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DesignCar extends Model
{
    use HasFactory;

    protected $table = 'design_car';

    protected $fillable = ['name_design_car'];
}
