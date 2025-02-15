<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class CarController extends Controller
{
    public function showPostsCar() {
        $cars = Post::with(['carBrand', 'designCar', 'address', 'user'])
            ->where('status', 'đã duyệt') // Lọc chỉ lấy bài post có status = 'chờ duyệt'
            ->paginate(5);
        return view('pages.user.cars', compact('cars'));
    }

    public function detailCar($id) {
        // dd($id);
        $car = Post::findOrFail($id);

        return view('pages.user.detailCar')->with('car', $car);
    }
}
