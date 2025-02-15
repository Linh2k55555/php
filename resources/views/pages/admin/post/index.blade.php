@extends('index')
@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Bài đăng</h1>
            <div class="d-flex justify-content-end">
                <a href="{{route('post.accepted')}}" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm ">Bài
                    đăng đã được duyệt</a>
                <a href="{{route('post.refused')}}"
                    class="d-none mx-2 d-sm-inline-block btn btn-sm btn-danger shadow-sm ">Bài
                    đăng đã từ chối</a>
                <a href="{{route('post.create')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">Tạo bài
                    đăng</a>
            </div>
        </div>
        <div class="shadow">
            <div class="card-body">
                <div class="table-responsive">
                    <form class="form-inline mw-100 navbar-search" action="{{route('post.search')}}">
                        @csrf
                        <div class="input-group">
                            <input type="search" class="form-control bg-light border-0 small" placeholder="Search post..."
                                aria-label="Search" aria-describedby="basic-addon2" name="search" id="form1">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="submit">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                    @if ($posts->isNotEmpty())
                        <div class="table-responsive mt-5">
                            <table class="table table-bordere text-center" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th style="min-width: 150px;">User</th>
                                        <th style="min-width: 100px;">Hình ảnh</th>
                                        <th style="min-width: 150px;">Tiêu đề</th>
                                        <th style="min-width: 120px;">Hãng xe</th>
                                        <th style="min-width: 120px;">Kiểu dáng</th>
                                        <th style="min-width: 150px;">Địa chỉ</th>
                                        <th style="min-width: 150px;">Năm sản xuất</th>
                                        <th style="min-width: 100px;">Km đã đi</th>
                                        <th style="min-width: 120px;">Nhiên liệu</th>
                                        <th style="min-width: 120px;">Hộp số</th>
                                        <th style="min-width: 100px;">Chỗ ngồi</th>
                                        <th style="min-width: 100px;">Giá</th>
                                        <th style="min-width: 100px;">Trạng thái</th>
                                        <th style="min-width: 100px;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        @foreach ($posts as $post)
                                                <td>{{$post->user->username ?? 'N/A' }}</td>
                                                <td><img src="{{ asset('storage/' . $post->url_picture) }}" alt="Image" width="100%">
                                                </td>
                                                <td>{{$post->title}}</td>
                                                <td>{{$post->carBrand->name_car_brand ?? 'N/A' }}</td>
                                                <td>{{$post->designCar->name_design_car ?? 'N/A'}}</td>
                                                <td>{{$post->address->province ?? 'N/A'}}</td>
                                                <td>{{$post->year}}</td>
                                                <td>{{$post->mileage}} km</td>
                                                <td>{{$post->fuel_type}}</td>
                                                <td>{{$post->gearbox}}</td>
                                                <td>{{$post->number_seats}}</td>
                                                <td>{{$post->price}}</td>
                                                <td>{{$post->status}}</td>
                                                <td>
                                                    @if ($flag == true)
                                                        <div class="d-flex justify-content-around">
                                                            <a href="{{ route('post.accept', $post->id)}}"
                                                                class="btn btn-sm btn-success shadow-sm"><i
                                                                    class="fa-solid fa-circle-check"></i></a>
                                                            <a href="{{ route('post.refuse', $post->id)}}"
                                                                class="btn btn-sm btn-danger shadow-sm ms-2"><i
                                                                    class="fa-solid fa-ban"></i></a>
                                                        </div>
                                                    @else
                                                        <a href="{{ route('post.delete', $post->id)}}"
                                                            class="btn btn-sm btn-secondary shadow-sm"><i class="fa-solid fa-trash"></i></a>
                                                    @endif

                                                </td>
                                            </tr>
                                        @endforeach
                                </tbody>
                            </table>
                            {{ $posts->links() }}
                        </div>
                    @else
                        <h4 class="text-center mt-4">Không có bài đăng</h4>
                    @endif



                </div>
            </div>
        </div>
    </div>


    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Thành công!',
                text: '{{ session('success') }}',
                showConfirmButton: false,
                timer: 2000
            });
        </script>
        {{-- Xóa thông báo sau khi hiển thị (Chỉ để hiển thị 1 lần) --}}
        {{ session()->forget('success') }}
    @endif



@endsection