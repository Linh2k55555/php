<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\BrandCar;
use App\Models\Post; // Use Post model to fetch car listings
use Hash;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::paginate(5);
        return view('pages.admin.user.index')->with('users', $users);
    }

    public function search(Request $request)
    {
        if ($request->input('search')) {
            $users = User::where(function ($query) use ($request) {
                $query->where('username', 'LIKE', '%' . $request->input('search') . '%')
                      ->orWhere('email', 'LIKE', '%' . $request->input('search') . '%');
            })->paginate(5);
        } else {
            $users = User::paginate(5);
        }
    
        return view('pages.admin.user.index')->with('users', $users);
    }

    public function delete($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('user.index')->with('success', 'Xóa người dùng thành công!');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'mat_khau' => 'required|string|min:6',
        ]);

        $user = User::where('email', $request->email)->first();

        if ($user && Hash::check($request->mat_khau, $user->password)) {
            session([
                'user_id' => $user->id,
                'username' => $user->username,
                'email' => $user->email,
            ]);

            // Fetch car brands and car posts
            $brandCars = BrandCar::all();
            $cars = Post::with(['carBrand', 'address', 'user'])->get(); // Load related models

            // Render the cars.blade.php page with data
            return view('pages.user.cars', compact('brandCars', 'cars'));
        }

        return back()->with('error', 'Sai thông tin đăng nhập! Vui lòng thử lại.');
    }

    public function logout(Request $request)
    {
        $request->session()->flush();
        return redirect()->route('home');
    }
}
