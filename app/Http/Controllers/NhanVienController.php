<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use App\Models\User;
use Illuminate\Http\Request;

class NhanVienController extends Controller
{
    public function index()
    {
        $staffs = Staff::paginate(5);
        return view('pages.admin.nhanvien.index')->with('staffs', $staffs);
    }

    public function search(Request $request)
    {
        if ($request->input('search')) {
            $staffs = Staff::where(function ($query) use ($request) {
                $query->where('username', 'LIKE', '%' . $request->input('search') . '%')
                      ->orWhere('email', 'LIKE', '%' . $request->input('search') . '%');
            })->paginate(5);
        } else {
            $staffs = Staff::paginate(5);
        }
    
        return view('pages.admin.nhanvien.index')->with('staffs', $staffs);
    }
    


    public function create()
    {
        return view('pages.admin.nhanvien.create');
    }

    public function store(Request $request)
    {
        // Validate the incoming request data
        $validated = $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|email|unique:staff,email', // Chú ý sửa 'users' thành 'staff'
            'password' => 'required|min:6',
        ], [
            'username.required' => 'Tên không được bỏ trống.',
            'username.string' => 'Tên phải là một chuỗi ký tự.',
            'username.max' => 'Tên không được vượt quá 255 ký tự.',
            'email.required' => 'Email không được bỏ trống.',
            'email.email' => 'Email phải có định dạng hợp lệ.',
            'email.unique' => 'Email đã được sử dụng. Vui lòng chọn một email khác.'
        ]);
    
        try {
            // Create the user
            $staff = Staff::create([
                'username' => $validated['username'],
                'email' => $validated['email'],
                'password' => bcrypt($validated['password']), // Hash the password for security
            ]);

    
            // Redirect with a success message
            return redirect()->route('nhanvien.index')->with('success', 'Người dùng được tạo thành công!');
        } catch (\Exception $e) {
            // Redirect with an error message if something goes wrong
            return redirect()->back()->with('error', 'Có lỗi xảy ra khi tạo người dùng. Vui lòng thử lại!');
        }
    }

    public function edit($id) {
        // dd($id);
        $staff = Staff::findOrFail($id);
        // dd($staffs);

        return view('pages.admin.nhanvien.edit')->with('staff', $staff);
    }

    public function update(Request $request){
        $validated = $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|email', // Chú ý sửa 'users' thành 'staff'
        ], [
            'username.required' => 'Tên không được bỏ trống.',
            'username.string' => 'Tên phải là một chuỗi ký tự.',
            'username.max' => 'Tên không được vượt quá 255 ký tự.',
            'email.required' => 'Email không được bỏ trống.',
            'email.email' => 'Email phải có định dạng hợp lệ.',
        ]);
        // dd('vhaj');
        try {
            $staff = Staff::findOrFail($request->input('id'));
   
            // Create the staff
            $staff->update([
                'username' => $validated['username'],
                'email' => $validated['email'],
                'password' => bcrypt($validated['password']), // Hash the password for security
            ]);
            // Redirect with a success message
            return redirect()->route('nhanvien.index')->with('success', 'Nhân viên được tạo thành công!');
        } catch (\Exception $e) {
            // Redirect with an error message if something goes wrong
            return redirect()->back()->with('error', 'Có lỗi xảy ra khi tạo nhân viên. Vui lòng thử lại!');
        }
    }

    public function delete($id)  {
        $staff = Staff::findOrFail($id);
        $staff->delete();
        return redirect()->route('nhanvien.index')->with('success', 'Xóa phòng trọ thành công!');
    }

}
