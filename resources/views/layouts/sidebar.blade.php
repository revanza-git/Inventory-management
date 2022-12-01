<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SINR</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">

    </script>
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
    {{-- Untuk Custom Accordions --}}
    <link rel="stylesheet" type="text/css" href="{{asset('css/customAccordions.css')}}">
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
                <h3>SINR</h3>
            </div>

            <ul class="list-unstyled components">
                <p>Sunter & ORF Warehouse</p>
                <li>
                    <a href="/home">Home</a>
                </li>
                @if (auth()->user()->role =='master')
                    <li class="active">
                        <a href="#pendingApproval" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Pending Approval</a>
                        <ul class="collapse list-unstyled" id="pendingApproval">
                            <li>
                                <a href="/flowInPendingMaster">In</a>
                            </li>
                            <li>
                               <a href="/flowOutPendingMaster">Out</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                     <a href="/report">Laporan</a>
                    </li>
                @endif
                @if (auth()->user()->role =='head')
                     <li class="active">
                            <a href="#pendingApproval" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Pending Approval <br>Docs</a>
                            <ul class="collapse list-unstyled" id="pendingApproval">
                                <li>
                                    <a href="/flowInPendingHead">In</a>
                                </li>
                                <li>
                                <a href="/flowOutPendingHead">Out</a>
                                </li>
                            </ul>
                     </li>
                     <li class="active">
                            <a href="#finalApprovalHead" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Pending Final <br>Approval</a>
                            <ul class="collapse list-unstyled" id="finalApprovalHead">
                                <li>
                                    <a href="/flowInFinalHead">In</a>
                                </li>
                                <li>
                                    <a href="/flowOutFinalHead">Out</a>
                                </li>
                            </ul>
                     </li>
                @endif
                @if (auth()->user()->role =='admin')
                    <li>
                        <a href="/addPart">Tambah Data Part Lampau</a>
                    </li>
                    {{-- <li class="active">
                        <a href="#pendingPart" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Pending Part</a>
                        <ul class="collapse list-unstyled" id="pendingPart">
                            <li>
                                <a href="/flowInPendingApproval">Part In</a>
                            </li>
                            <li>
                                <a href="/flowOutPendingApproval">Part Out</a>
                            </li>
                        </ul>
                    </li> --}}
                    <li class="active">
                        <a href="#pendingApproval" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Pending Approval </br>Docs</a>
                        <ul class="collapse list-unstyled" id="pendingApproval">
                            <li>
                                <a href="/flowInPendingApprovalDate">In</a>
                            </li>
                            <li>
                                <a href="/flowOutPendingApprovalDate">Out</a>
                            </li>
                        </ul>
                    </li>
                    <li class="active">
                        <a href="#pendingApprovalFisik" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Pending Approval </br>Fisik</a>
                        <ul class="collapse list-unstyled" id="pendingApprovalFisik">
                            <li>
                                <a href="/flowInPendingApprovalFisik">In</a>
                            </li>
                            <li>
                                <a href="/flowOutPendingApprovalFisik">Out</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                     <a href="/report">Laporan </a>
                    </li>
                @endif
                @if (auth()->user()->role =='user')
                    <li>
                        <a href="/addPart">Tambah Data Part</a>
                    </li>
                    <li>
                        <a href="/myRequest">My Pending Request</a>
                    </li>
                @endif
                {{-- OPEN --}}
                <li class="active">
                    <a href="#approveForm" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Approved Form</a>
                    <ul class="collapse list-unstyled" id="approveForm">
                        <li><a href="/ftb">FTB</a></li>
                        <li><a href="/fkb">FKB</a></li>
                    </ul>
                </li>
                
                
                
                <li class="active">
                    <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Data Barang</a>
                    <ul class="collapse list-unstyled" id="homeSubmenu">
                        <li>
                            <a href="/electrical">Electrical</a>
                        </li>
                        <li>
                            <a href="/instrument">Instrument</a>
                        </li>
                        <li>
                            <a href="/mechanical">Mechanical</a>
                        </li>
                        <li>
                            <a href="/provision">Provision Tie In</a>
                        </li>
                        <li>
                            <a href="/emergency">Emergency</a>
                        </li>
                        <li>
                            <a href="/reliability">Titipan Reliability</a>
                        </li>
                        <li>
                            <a href="/scrap">Scrap R & Q</a>
                        </li>
                        <li>
                            <a href="/technology">Titipan IT</a>
                        </li>
                        <li>
                            <a href="/tiyum">Titipan Layum</a>
                        </li>
                        <li>
                            <a href="/scrayum">Scrap Layum</a>
                        </li>
                        <li>
                            <a href="/sekper">Titipan Sekper</a>
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
                $('#reportTable').DataTable({
                     "scrollX": true,  
                 });
                $('#reportKategoriTable').DataTable({
                    "scrollX": true, 
                    "columnDefs": [
                        { "width": "10%", "targets": 0 },
                        { "width": "20%", "targets": 1 },
                        { "width": "40%", "targets": 2 },
                        { "width": "50%", "targets": 3 },
                        { "width": "10%", "targets": 4 },
                        { "width": "10%", "targets": 5 },
                        { "width": "10%", "targets": 6 },
                        { "width": "50%", "targets": 7 }
                    ]
                 }); 
                } );
        </script>



        <script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
        <script src="{{asset('js/alert.js')}}"></script>
        
@endauth         
</body>

</html>