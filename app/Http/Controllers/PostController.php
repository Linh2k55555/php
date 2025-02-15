<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\BrandCar;
use App\Models\DesignCar;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with(['carBrand', 'designCar', 'address', 'user'])
            ->where('status', 'chờ duyệt') // Lọc chỉ lấy bài post có status = 'chờ duyệt'
            ->paginate(5);
        $flag = true; // để phân biệt trang index với accepted
        return view('pages.admin.post.index', compact('posts', 'flag'));
    }

    public function create()
    {
        $address = Address::all();
        $brand_cars = BrandCar::all();
        $design_cars = DesignCar::all();


        return view('pages.admin.post.create', compact('address', 'brand_cars', 'design_cars'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required',
            'car_brand' => 'required',
            'design_car' => 'required',
            'address' => 'required',
            'fuel_type' => 'required',
            'gearbox' => 'required',
            'url_picture' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // validate ảnh
            'price' => 'required',
            'year' => 'required',
            'mileage' => 'required',
            'mau_xe' => 'required',
            'number_seats' => 'required',
        ], [
            'title.required' => 'Title không được bỏ trống.',
            'url_picture.required' => 'Đường dẫn ảnh không được bỏ trống.',
            'price.required' => 'Giá không được bỏ trống.',
            'year.required' => 'Năm không được bỏ trống.',
            'mileage.required' => 'Số km đã đi không được bỏ trống.',
            'mau_xe.required' => 'Màu xe không được bỏ trống.',
            'number_seats.required' => 'Số chỗ ngồi không được bỏ trống.',
        ]);


        try {
            $imagePath = null; // Định nghĩa trước để tránh lỗi undefined variable
            if ($request->hasFile('url_picture')) {
                $image = $request->file('url_picture');
                $imagePath = $image->store('images', 'public');
            }

            // dd($validated);
            $post = Post::create([
                'title' => $validated['title'],
                'id_car_brand' => $validated['car_brand'],
                'id_design_car' => $validated['design_car'],
                'id_address' => $validated['address'],
                'fuel_type' => $validated['fuel_type'],
                'gearbox' => $validated['gearbox'],
                'url_picture' => $imagePath,
                'price' => $validated['price'],
                'year' => $validated['year'],
                'mileage' => $validated['mileage'],
                'mau_xe' => $validated['mau_xe'],
                'number_seats' => $validated['number_seats'],
                'status' => 'chờ duyệt',
                'id_user' => 6,
            ]);



            // Redirect with a success message
            return redirect()->route('post.index')->with('success', 'Đăng bài thành công!');
        } catch (\Exception $e) {
            // Redirect with an error message if something goes wrong
            return redirect()->back()->with('error', 'Có lỗi xảy ra khi tạo đăng bài. Vui lòng thử lại!');
        }
    }

    public function accept($id)
    {

        $post = Post::findOrFail($id);
        $post->status = 'đã duyệt';
        $post->save();

        return redirect()->back()->with('success', 'Bài post đã được duyệt!');
    }

    public function refuse($id)
    {

        $post = Post::findOrFail($id);
        $post->status = 'bị từ chối';
        $post->save();

        return redirect()->back()->with('success', 'Bài post đã bị từ chối!');
    }

    public function delete($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();
        return redirect()->back()->with('success', 'Bài post đã bị xóa!');
    }

    public function accepted()
    {
        $posts = Post::with(['carBrand', 'designCar', 'address', 'user'])
            ->where('status', 'đã duyệt') // Lọc chỉ lấy bài post có status = 'chờ duyệt'
            ->paginate(5);
        $flag = false;
        return view('pages.admin.post.index', compact('posts', 'flag'));
    }

    public function refused()
    {
        $posts = Post::with(['carBrand', 'designCar', 'address', 'user'])
            ->where('status', 'bị từ chối') // Lọc chỉ lấy bài post có status = 'chờ duyệt'
            ->paginate(5);

        $flag = false;
        return view('pages.admin.post.index', compact('posts', 'flag'));
    }

    public function search(Request $request)
    {
        $flag = true;
        if ($request->input('search')) {
            $posts = Post::where(function ($query) use ($request) {
                $query->where('title', 'LIKE', '%' . $request->input('search') . '%');
            })->paginate(5);
        } else {
            $posts = Post::paginate(5);
        }
    
        return view('pages.admin.post.index', compact('posts', 'flag'));
    }
}
