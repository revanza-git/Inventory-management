<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Security-Policy" content="default-src 'self'; script-src 'self' 'unsafe-inline' cdn.jsdelivr.net; style-src 'self' 'unsafe-inline' cdn.jsdelivr.net; img-src 'self' data:;">
    <meta http-equiv="X-Frame-Options" content="DENY">
    <meta http-equiv="X-Content-Type-Options" content="nosniff">
    <meta http-equiv="Referrer-Policy" content="strict-origin-when-cross-origin">

    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">

    <link rel="stylesheet" type="text/css" href="{{asset('css/login.css')}}">
    <link rel="stylesheet" href="{{asset('css/customWeb.css')}}">


    <title>Inventory System</title>
</head>

<body>
    <div class="row mx-0 auth-wrapper">
    <!--remove bg-->
    <ul class="circles">
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
    </ul>
    <div class="d-none d-sm-flex col-sm-6 col-lg-8 align-items-center p-5">
        <div class="align-items-start d-lg-flex flex-column offset-lg-2 text-white">
         
                <h1 class="fw-bold mb-2 text-uppercase"><span id="typed"></span></h1>
                <p>Enterprise Inventory Management System</p>
            </div>
        </div>
        <div
            class="d-flex justify-content-center col-sm-6 col-lg-4 align-items-center px-5 bg-white mx-auto">
            <div class="form-wrapper">
                <div class="d-flex flex-column">
                    <div class="mb-4">
                        <img src="/images/logo.png" alt="Company Logo" width="60%"  class="d-inline-block align-text-top mb-4">
                        <h3 class="font-medium mb-1 mt-2">Login</h3>
                        @if (session()->has('success'))
                                <div class="alert greenAdd" role="alert" id="box">
                                    <div>{{session('success')}}</div>
                                </div>
                        @endif
                        @if (session()->has('loginError'))
                                <div class="alert alert-danger" role="alert" id="box">
                                    <div>{{session('loginError')}}</div>
                                </div>
                        @endif
                        @if (session()->has('attempts'))
                            <div class="alert alert-warning" role="alert" id="box">
                                <div>Too many login attempts. Please try again in {{session('attempts')}} minutes.</div>
                            </div>
                        @endif
                    </div>
                    <form action="{{ url('/login') }}" method="POST" autocomplete="off">
                    @csrf
                    <div class="mb-10">
                            <div class="form-group">
                                <label>Email / Username</label>
                                <input name="email" type="text" class="form-control" required autocomplete="username">
                            </div>
                            <div class="form-group mb-5">
                                <label for="password">Password</label>
                                <input name="password" type="password" class="form-control" required autocomplete="current-password">
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-block mt-3 border-0 mb-5">
                                    Log in
                                </button>
                            </div>
                            
                        </div>

                    </div>
                    </form>
                    <div style="margin-top: 50px;">
                        <a href="/" target="_blank">
                            © {{ date('Y') }} Copyright : Revanza Raytama
                        </a>
                    </div>
                </div>
                

            </div>
        </div>
       



    <script src="https://cdn.jsdelivr.net/npm/typed.js@2.0.12"></script>


    <script>
        var typed = new Typed('#typed', {
            strings: ['Login', 'Inventory System', 'Inventory Management System'],
            loop: true,
            typeSpeed: 100,
        });
    </script>
    <script src="{{asset('js/alert.js')}}"></script>
</body>

</html>