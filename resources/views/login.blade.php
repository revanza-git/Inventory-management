<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="shortcut icon" href="{{ asset('faviconNX.ico') }}">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">

    <link rel="stylesheet" type="text/css" href="{{asset('css/login.css')}}">
    <link rel="stylesheet" href="{{asset('css/customWeb.css')}}">


    <title>SINP</title>
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
                <p>a joint venture company between PERTAMINA & PGN</p>
            </div>
        </div>
        <div
            class="d-flex justify-content-center col-sm-6 col-lg-4 align-items-center px-5 bg-white mx-auto">
            <div class="form-wrapper">
                <div class="d-flex flex-column">
                    <div class="mb-4">
                        <img src="https://nusantararegas.com/users/images/nr-logo.png" alt="" width="60%"  class="d-inline-block align-text-top mb-4">
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
                    </div>
                    <form action="/login" method="POST">
                    @csrf
                    <div class="mb-10">
                            <div class="form-group">
                                <label>Email</label>
                                <input name="email" type="text" class="form-control"></input>
                            </div>
                            <div class="form-group mb-5">
                                <label for="password" class="">Password</label>
                                <input name="password" type="password" class="form-control"></div>
                                <div class="text-right">
                                
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
                        <a href="https://www.linkedin.com/in/rifqi-adliansyah" target="_blank">
                            © 2022 Copyright : Rifqi Adliansyah
                        </a> / 
                        <a href="https://wa.me/+6282111163397" target="_blank">
                            <i class="bi bi-whatsapp"></i>
                        </a>
                    </div>
                </div>
                

            </div>
        </div>
       



    <script src="https://cdn.jsdelivr.net/npm/typed.js@2.0.12"></script>


    <script>
        var typed = new Typed('#typed', {
            strings: ['Login', 'Inventory System', 'Nusantara Regas'],
            loop: true,
            typeSpeed: 100,
        });
    </script>
    <script src="{{asset('js/alert.js')}}"></script>
</body>

</html>