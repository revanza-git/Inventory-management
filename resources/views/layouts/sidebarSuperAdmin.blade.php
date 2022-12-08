<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SINV</title>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">

    </script>
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous">
    </script>
    {{-- INI YG BIKIN BUG --}}
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">

    {{-- Data Tables CDN --}}
    <link rel="stylesheet" href="//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">

    {{-- Favicon --}}
    <link rel="shortcut icon" href="{{ asset('faviconNX.ico') }}">
    {{-- Untuk Sidebar --}}
    <link rel="stylesheet" type="text/css" href="{{asset('css/sideBar.css')}}">
    {{-- Styling Web --}}
    <link rel="stylesheet" href="{{asset('css/customWeb.css')}}">
    {{-- Styling button back to top css --}}
    <link rel="stylesheet" href="{{asset('css/backtoTopButton.css')}}">
    {{-- CDN CHART JS --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
   {{-- CDN LABELS CHART JS --}}
    <script src="https://unpkg.com/chart.js-plugin-labels-dv/dist/chartjs-plugin-labels.min.js"></script>
</head>

<body>
    @auth
    <div class="wrapper">
        <!-- Sidebar  -->
        <nav id="sidebar">
            <div class="sidebar-header">
                <h3>SINV</h3>
            </div>

            <ul class="list-unstyled components">
                <p>Sunter & ORF Warehouse</p>
                <li class="active">
                    <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Account</a>
                    <ul class="collapse list-unstyled" id="homeSubmenu">
                        <li>
                            <a href="/register">Register</a>
                        </li>
                        <li>
                            <a href="/resetPassword">Reset Password</a>
                        </li>
                    </ul>
                </li>
                
                <li>
                    <form action="/logout" method="post" style="margin: 5px">
                        @csrf
                        <button type="submit" style="background: #293462; color:white; border:none;">Logout</button>
                    </form>
                    
                </li>
                
            </ul>
        </nav>

        <!-- Page Content  -->
        <div id="content">
            <nav class="navbar navbar-expand-lg navbar-light " id="kontainer-head">
                <div class="container-fluid" id="kontainer-head">
                    {{-- <button type="button" id="sidebarCollapse" class="btn btn-info">
                        <i class="fas fa-th-large"></i>
                        
                    </button> --}}
                    <div class="container-fluid mt-3">
                        <h3 style="color: #ffff;">
                            <marquee>Selamat Datang Kembali {{auth()->user()->name}} di Inventory Management System! Semangat Kerjanya #JanganLupaNgopi</marquee>
                        </h3>
                    </div>

                </div>
            </nav>
           
            <div class="container-fluid" style="margin 10px;">
                <!-- Buat naro konten dari php -->
                @yield('content')
            </div>
        </div>
        {{-- Script sidebar --}}
        <script>
            $(document).ready(function() {
                $('#sidebarCollapse').on('click', function() {
                    $('#sidebar').toggleClass('active');
                });
            });
        </script>
        
        <script>
            $(document).ready( function () {
                $('#myTable').DataTable();
                $('#traceTable').DataTable();
                $('#tableInElectrical').DataTable();
                $('#tableIn').DataTable();
                $('#tableOut').DataTable();
                $('#tableFormCustom').DataTable({
                    "searching": false,
                    "paging": false,
                    "info": false
                });
                $('#tableWithoutSearch').DataTable({
                    "searching": false,
                    "paging": false,
                    "info": false
                });
            } );
        </script>



        <script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
        <script src="{{asset('js/alert.js')}}"></script>
        
@endauth         
</body>

</html>