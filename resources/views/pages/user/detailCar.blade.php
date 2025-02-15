@extends('index')
@section('content')
    <div class="container-fluid">
        {{-- <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Cars</h1>
            <div class="d-flex justify-content-end">
                <a href="{{route('post.create')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">Đăng
                    bài</a>
            </div>
        </div> --}}

        <div class="row">
            <div class="col-md-7">
                <img src={{ asset('storage/' . $car->url_picture) }} alt="raptor" width="100%" class="mb-2" />
            </div>
            <div class="col-md-5">
                <div class="thongtin">
                    <p class="name">{{ $car->carBrand->name_car_brand ?? 'N/A' }} {{ $car->title}}</p>
                    <p class="text-secondary my-1">{{ $car->designCar->name_design_car ?? 'N/A'}}</p>
                    <p class="price">{{ $car->price}}</p>
                    <div class="item">
                        <p><i class="fa-solid fa-calendar"></i> Năm sản xuất</p>
                        <p>{{ $car->year}}</p>
                    </div>
                    <div class="item">
                        <p><i class="fa-solid fa-road"></i> Đã lăn bánh</p>
                        <p>{{ $car->mileage}} km</p>
                    </div>
                    <div class="item">
                        <p><i class="fa-solid fa-gas-pump"></i> Nhiên liệu</p>
                        <p>{{ $car->fuel_type}}</p>
                    </div>
                    <div class="item">
                        <p><i class="fa-solid fa-palette"></i> Màu</p>
                        <p>{{ $car->mau_xe}}</p>
                    </div>
                    <div class="item">
                        <p><i class="fa-solid fa-gears"></i> Hộp số</p>
                        <p>{{ $car->gearbox}}</p>
                    </div>
                    <div class="item">
                        <p><i class="fa-solid fa-couch"></i> Chỗ ngồi</p>
                        <p>{{ $car->number_seats}}</p>
                    </div>
                    
                    <hr />
                    <div class="item">
                        <p><i class="fa-solid fa-user"></i> Người bán</p>
                        <p>{{ $car->user->username ?? 'N/A'}}</p>
                    </div>
                    <div class="item">
                        <p><i class="fa-solid fa-location-dot"></i> Địa điểm</p>
                        <p>{{ $car->address->province ?? 'N/A'}}</p>
                    </div>
                    <div class="goi">
                        <a class="btn" href="https://zalo.me/{{ $car->user->phone_number }}" target="_blank"><i class="fa-solid fa-phone"></i>Gọi điện</a>
                        <a class="btn" href="https://zalo.me/{{ $car->user->phone_number }}" target="_blank"><i class="fa fa-envelope"></i>Nhắn tin</a>
                    </div>
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