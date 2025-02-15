<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BrandCar extends Model
{
    use HasFactory;

    protected $table = 'car_brand';

    protected $fillable = ['name_car_brand'];
}
