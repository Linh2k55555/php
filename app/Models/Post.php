<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $table = 'post';

    protected $fillable = [
        'title', 'car_brand', 'design_car', 'address', 'fuel_type', 'gearbox', 'url_picture',
        'price', 'year', 'mileage', 'mau_xe', 'number_seats', 'status', 'id_design_car', 
        'id_user', 'id_car_brand', 'id_address'
    ];

    public function carBrand()
    {
        return $this->belongsTo(BrandCar::class, 'id_car_brand');
    }

    // Quan hệ với bảng DesignCar
    public function designCar()
    {
        return $this->belongsTo(DesignCar::class, 'id_design_car');
    }

    public function address()
    {
        return $this->belongsTo(Address::class, 'id_address');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
