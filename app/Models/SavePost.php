<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SavePost extends Model
{
    use HasFactory;

    protected $table = 'see_later';

    protected $fillable = [
        'id_user', 'id_post'
    ];

    public function post()
    {
        return $this->belongsTo(Post::class, 'id_post');
    }

    // Quan hệ với bảng DesignCar
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

}
