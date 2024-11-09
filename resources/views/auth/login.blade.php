<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>InvenTrade | Log in </title>

    <!-- Google Font: Source Sans Pro -->
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="/plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="/css/adminlte.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.3/dist/sweetalert2.all.min.js"></script>
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="card card-outline card-dark">
            <div class="card-header text-center">
                <a href="/" class="h1"><b>Inven</b>Trade</a>
            </div>
            <div class="card-body">

                <form action="{{ route('login.check') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" id="username" name="username"
                            placeholder="Enter Username">
                        @error('username')
                            <span id="username" class="error invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" class="form-control" id="password" name="password"
                            placeholder="Password">
                        @error('password')
                            <span id="password" class="error invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="row d-flex justify-content-between mb-2">
                        <div class="col-6">
                            <div class="icheck-dark">
                                <input type="checkbox" id="remember" name="remember">
                                <label for="remember">
                                    Remember Me
                                </label>
                            </div>
                        </div>
                        <div class="col-6">
                            <p class="text-right"><a href=""><strong>Forgot Password?</strong></a></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <button type="submit" style="width: 100%;" class="btn btn-dark">Sign In</button>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-12">
                            <p class="mb-0">Don't have an account? <a href="">Register</a></p>
                        </div>
                    </div>
                </form>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="/js/adminlte.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.3/dist/sweetalert2.min.css">


    <script>
        @if(session('errors'))
            let errors = '';
            @foreach (session('errors')->all() as $error)
                errors += '{{ $error }}\n';
            @endforeach
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: errors,
            });
        @endif
    </script>
    
</body>

</html>
