<?php

namespace App\Http\Controllers;

use App\Models\NguoiDung;
use App\Models\User;
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

    public function delete($id)  {
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

        $nguoiDung = NguoiDung::where('email', $request->email)->first();

        if ($nguoiDung && Hash::check($request->mat_khau, $nguoiDung->mat_khau)) {
            session([
                'nguoi_dung_id' => $nguoiDung->id_nguoi_dung,
                'ten_nguoi_dung' => $nguoiDung->ten_nguoi_dung,
                'email' => $nguoiDung->email,
            ]);

            return redirect()->route('home');
        }


        return back();
    }

    public function logout(Request $request)
    {
        $request->session()->flush();
        return redirect()->route('home');
    }
}
