@extends('index')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-6 col-md-12">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row justify-content-center">
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Login!</h1>
                                    </div>
                                    <!-- Login Form -->
                                    <form class="user" action="{{ route('login') }}" method="POST">
    @csrf
    <div class="form-group">
        <input type="email" class="form-control form-control-user"
            id="exampleInputEmail" aria-describedby="emailHelp"
            placeholder="Enter Email Address..." name="email" required>
    </div>
    <div class="form-group">
        <input type="password" class="form-control form-control-user"
            id="exampleInputPassword" placeholder="Password" name="mat_khau" required>
    </div>
    <button type="submit" class="btn btn-primary btn-user btn-block">
        Login
    </button>
</form>

                                    <hr>
                                    <a href="index.html" class="btn btn-google btn-user btn-block">
                                        <i class="fab fa-google fa-fw"></i> Login with Google
                                    </a>
                                    <a href="index.html" class="btn btn-facebook btn-user btn-block">
                                        <i class="fab fa-facebook-f fa-fw"></i> Login with Facebook
                                    </a>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="forgot-password.html">Forgot Password?</a>
                                    </div>
                                    <div class="text-center">
                                        <a class="small" href="{{ route('register') }}">Create an Account!</a>
                                    </div>
                                </div>
                            </div>
                        </div>
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
                timer: 3000
            });
        </script>
        {{ session()->forget('success') }}
    @endif
@endsection
