@extends('index')
@section('content')
    <div class="container-fluid">

        <div class="row">
            @foreach ($cars as $car)
                <div class="col-lg-4 col-md-6 col-sm-12 mb-3">
                    <div class="shadow">
                        <div class="card-sl">
                            <a href="{{ route('save.delete', $car->id_post)}}" class="btn btn-danger btn-circle nut_delete">
                                <i class="fas fa-trash"></i>
                            </a>
                            <div class="card-image">
                                <a href="{{ route('cars.detail', $car->post->id)}}"><img src="{{ asset('storage/' . $car->post->url_picture) }}" alt="Image" width="100%"></a>
                            </div>
                            <div class="card-heading">
                                {{$car->post->carBrand->name_car_brand ?? 'N/A' }} {{$car->post->title}}
                            </div>
                            <div class="card-text">
                                {{$car->post->price}}
                            </div>
                            <div class="card-text">
                                <div class="row">
                                    <div class="col-sm-3">
                                          <div class="d-flex align-items-center">
                                            <i class="fa-solid fa-calendar"></i>
                                            <p class="my-0 mx-2">{{$car->post->year}}</p>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="d-flex align-items-center">
                                            <i class="fa-solid fa-car"></i>
                                            <p class="my-0 mx-2">{{$car->post->number_seats}} chỗ</p>
                                        </div>
                                    </div>
                                    <div class="col-sm-5">
                                          <div class="d-flex align-items-center">
                                            <i class="fa-solid fa-gears"></i>
                                            <p class="my-0 mx-2">{{$car->post->gearbox}}</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-3">
                                    <div class="col-sm-3">
                                          <div class="d-flex align-items-center">
                                            <i class="fa-solid fa-gas-pump"></i>
                                            <p class="my-0 mx-2">{{$car->post->fuel_type}}</p>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                          <div class="d-flex align-items-center">
                                            <i class="fa-solid fa-road"></i>
                                            <p class="my-0 mx-2">{{$car->post->mileage}} km</p>
                                        </div>
                                    </div>
                                    <div class="col-sm-5">
                                          <div class="d-flex align-items-center">
                                            <i class="fa-solid fa-location-dot"></i>
                                            <p class="my-0 mx-2">{{$car->post->address->province ?? 'N/A'}}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-6 d-flex justify-content-center">
                                    <a href="{{ route('cars.detail', $car->post->id)}}"
                                        class="btn btn-primary shadow-sm w-100">Chi tiết</a>
                                </div>
                                <div class="col-sm-6 d-flex justify-content-center">
                                    <a href="https://zalo.me/{{ $car->post->user->phone_number }}" target="_blank"
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
        {{-- Xóa thông báo sau khi hiển thị (Chỉ để hiển thị 1 lần) --}}
        {{ session()->forget('success') }}
    @endif



@endsection