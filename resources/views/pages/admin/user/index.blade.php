@extends('index')
@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Users</h1>
            {{-- <a href="{{route('nhanvien.create')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">Create
                staff</a> --}}
        </div>
        <div class="shadow">
            <div class="card-body">
                <div class="table-responsive">
                    <form class="form-inline mw-100 navbar-search" action="{{route('user.search')}}">
                        @csrf
                        <div class="input-group">
                            <input type="search" class="form-control bg-light border-0 small" placeholder="Search user..."
                                aria-label="Search" aria-describedby="basic-addon2" name="search" id="form1">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="submit">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>





                    <table class="table table-bordered mt-5" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Phone number</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                @foreach ($users as $user)
                                        <td>{{$user->id}}</td>
                                        <td>{{$user->username}}</td>
                                        <td>{{$user->email}}</td>
                                        <td>{{$user->phone_number}}</td>
                                        <td>
                                            <a href="{{route('user.delete', $user->id)}}"
                                                class="btn btn-sm btn-danger shadow-sm">Delele</a> 
                                        </td>


                                    </tr>
                                @endforeach
                        </tbody>
                    </table>

                    {{ $users->links() }}
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
                timer: 3000
            });
        </script>
        {{-- Xóa thông báo sau khi hiển thị (Chỉ để hiển thị 1 lần) --}}
        {{ session()->forget('success') }}
    @endif



@endsection