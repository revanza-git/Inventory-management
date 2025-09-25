@extends('layouts.sidebarSuperAdmin')
@section('content')
<h1>Daftar Pengguna Sistem</h1>

@if (session()->has('failed'))
    <div class="alert alert-danger" role="alert" id="box">
        <div>{{session('failed')}}</div>
    </div>
@elseif (session()->has('success'))
    <div class="alert greenAdd" role="alert" id="box">
        <div>{{session('success')}}</div>
    </div>
@endif

<div class="row mt-3">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5>Total Pengguna: {{ count($users) }}</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="myTable" class="table table-bordered table-hover table-striped">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Email / Username</th>
                                <th scope="col">Role</th>
                                <th scope="col">Departement</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($users as $user)
                            <tr>
                                <td scope="row">{{$loop->iteration}}</td>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                <td>
                                    @if($user->role == 'superadmin')
                                        <span class="badge bg-danger">Super Admin</span>
                                    @elseif($user->role == 'master')
                                        <span class="badge bg-warning">Master</span>
                                    @elseif($user->role == 'admin')
                                        <span class="badge bg-primary">Admin</span>
                                    @elseif($user->role == 'head')
                                        <span class="badge bg-info">Head</span>
                                    @else
                                        <span class="badge bg-secondary">User</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($user->departement == 'reliability')
                                        Reliability
                                    @elseif ($user->departement == 'layum')
                                        Layanan Umum
                                    @elseif ($user->departement == 'technology')
                                        IT
                                    @elseif ($user->departement == 'sekper')
                                        Sekretaris Perusahaan
                                    @elseif ($user->departement == 'procurement')
                                        Procurement
                                    @elseif ($user->departement == 'hsse')
                                        HSSE
                                    @elseif ($user->departement == 'migas')
                                        Distribusi Gas dan Manajemen ORF
                                    @elseif ($user->departement == 'transportasi')
                                        Transportasi LNG & Operasional FSRU
                                    @elseif ($user->departement == 'bisnis')
                                        Perencanaan & Pengembangan Bisnis
                                    @else
                                        {{$user->departement}}
                                    @endif
                                </td>
                                <td>
                                    <a type="button" class="btn btn-sm btn-outline-primary" 
                                        href="/inventory/showAccount/{{$user->id}}" title="View Details">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                            <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                                            <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
                                        </svg>
                                        View
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center">
                                    Tidak ada pengguna terdaftar
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Initialize DataTable if available
    if (typeof $('#myTable').DataTable === 'function') {
        $(document).ready(function() {
            $('#myTable').DataTable({
                "pageLength": 25,
                "order": [[ 0, "asc" ]], // Sort by number ascending
                "language": {
                    "search": "Cari:",
                    "lengthMenu": "Tampilkan _MENU_ data per halaman",
                    "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                    "paginate": {
                        "first": "Pertama",
                        "last": "Terakhir",
                        "next": "Selanjutnya",
                        "previous": "Sebelumnya"
                    }
                }
            });
        });
    }
</script>
@endsection