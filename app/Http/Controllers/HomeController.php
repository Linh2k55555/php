<?php

namespace App\Http\Controllers;

use App\Models\SavePost;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function showPageHome()
    {
        return view('pages.user.dashboard');
    }
    public function showRegisterForm()
    {
        return view('pages.user.register');
    }

    public function registerStore(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|email|unique:user,email',
            'phone_number' => 'required|numeric|digits:10',
            'password' => 'required|string|min:6|',
            'confirm_password' => 'required|same:password',
        ], [
            'username.required' => 'Tên không được bỏ trống.',
            'username.string' => 'Tên phải là một chuỗi ký tự.',
            'username.max' => 'Tên không được vượt quá 255 ký tự.',
            'email.required' => 'Email không được bỏ trống.',
            'email.email' => 'Email phải có định dạng hợp lệ.',
            'email.unique' => 'Email đã được sử dụng. Vui lòng chọn một email khác.',
            'phone_number.required' => 'Số điện thoại không được bỏ trống.',
            'phone_number.digits' => 'Số điện thoại phải là 10 số.',
            'password.required' => 'Mật khẩu không được bỏ trống.',
            'password.min' => 'Mật khẩu phải từ 6 ký tự.',
            'confirm_password.same' => 'Mật khẩu không trùng khớp.',
        ]);

        try {
            // Create the user
            User::create([
                'username' => $validated['username'],
                'email' => $validated['email'],
                'phone_number' => $validated['phone_number'],
                'password' => bcrypt($validated['password']), // Hash the password for security
            ]);

            // Redirect with a success message
            return redirect()->route('login')->with('success', 'Đăng ký thành công!');
        } catch (\Exception $e) {
            // Redirect with an error message if something goes wrong
            return redirect()->back()->with('error', 'Có lỗi xảy ra khi tạo đăng ký. Vui lòng thử lại!');
        }

        // return redirect()->route('login');
    }

    public function showLoginForm()
    {
        return view('pages.user.login');
    }

    public function save($id)
    {
        try {
            // Create the user
            SavePost::create([
                'id_post' => $id,
                'id_user' => 1,
            ]);

            // Redirect with a success message
            return redirect()->route('cars')->with('success', 'Đã lưu bài viết vào mục xem sau');
        } catch (\Exception $e) {
            // Redirect with an error message if something goes wrong
            return redirect()->back()->with('error', 'Có lỗi xảy ra khi lưu bài viết. Vui lòng thử lại!');
        }
    }

    public function showPageSave()
    {
        $cars = SavePost::with(['post.address', 'post.user', 'post.carBrand', 'post.designCar'])
            ->where('id_user', 1)
            ->get();

        return view('pages.user.save-post', compact('cars'));
    }

    public function deleteSave($id)
    {
        // $car = SavePost::findOrFail($id);
        // $car->delete();

        $car = SavePost::where('id_post', $id)
            ->where('id_user', 1) // Chỉ xóa bài viết của user có id = 1
            ->firstOrFail(); // Lấy 1 bản ghi hoặc báo lỗi 404 nếu không tìm thấy

        $car->delete(); // Xóa bản ghi
        return redirect()->route('save.index');
    }
}
