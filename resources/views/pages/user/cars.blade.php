@extends('index')

@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Danh sách xe</h1>
            <div class="d-flex justify-content-end">
                <a href="{{route('post.create')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">Đăng bài</a>
            </div>
        </div>

        <!-- Car Brands Section -->
        <div class="row mb-4">
            <h3 class="h5 text-gray-800">Hãng Xe</h3>
            @foreach ($brandCars as $brand)
                <div class="col-md-2 col-sm-4 mb-3">
                    <div class="card text-center shadow">
                        <div class="card-body">
                            <h5 class="card-title">{{ $brand->name_car_brand }}</h5>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Car Listings Section -->
        <div class="row">
            @foreach ($cars as $car)
                <div class="col-lg-4 col-md-6 col-sm-12 mb-3">
                    <div class="shadow">
                        <div class="card-sl">
                            <div class="card-image">
                                <a href="{{ route('cars.detail', $car->id) }}">
                                    <img src="{{ asset('storage/' . $car->url_picture) }}" alt="Image" width="100%">
                                </a>
                            </div>
                            <a class="card-action" href="{{ route('save', $car->id) }}"><i class="fa-solid fa-bookmark"></i></a>
                            <div class="card-heading">
                                {{ $car->carBrand->name_car_brand ?? 'N/A' }} - {{ $car->title }}
                            </div>
                            <div class="card-text">
                                Giá: {{ number_format($car->price, 0, ',', '.') }} VNĐ
                            </div>
                            <div class="card-text">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="d-flex align-items-center">
                                            <i class="fa-solid fa-calendar"></i>
                                            <p class="my-0 mx-2">{{ $car->year }}</p>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="d-flex align-items-center">
                                            <i class="fa-solid fa-car"></i>
                                            <p class="my-0 mx-2">{{ $car->number_seats }} chỗ</p>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="d-flex align-items-center">
                                            <i class="fa-solid fa-gears"></i>
                                            <p class="my-0 mx-2">{{ $car->gearbox }}</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-3">
                                    <div class="col-sm-4">
                                        <div class="d-flex align-items-center">
                                            <i class="fa-solid fa-gas-pump"></i>
                                            <p class="my-0 mx-2">{{ $car->fuel_type }}</p>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="d-flex align-items-center">
                                            <i class="fa-solid fa-road"></i>
                                            <p class="my-0 mx-2">{{ number_format($car->mileage) }} km</p>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="d-flex align-items-center">
                                            <i class="fa-solid fa-location-dot"></i>
                                            <p class="my-0 mx-2">{{ $car->address->province ?? 'N/A' }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-sm-6 d-flex justify-content-center">
                                    <a href="{{ route('cars.detail', $car->id)}}" class="btn btn-primary shadow-sm w-100">Chi tiết</a>
                                </div>
                                <div class="col-sm-6 d-flex justify-content-center">
                                    <a href="https://zalo.me/{{ $car->user->phone_number }}" target="_blank"
                                        class="btn btn-success shadow-sm w-100">Liên hệ</a>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            @endforeach
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
        {{ session()->forget('success') }}
    @endif
@endsection
