@extends('layouts.sidebarSuperAdmin')
@section('content')
<h1>Akun Terdaftar</h1>

@if (session()->has('failed'))
    <div class="alert alert-danger" role="alert" id="box">
        <div>{{session('failed')}}</div>
    </div>
@elseif (session()->has('success'))
    <div class="alert greenAdd" role="alert" id="box">
        <div>{{session('success')}}</div>
    </div>
@endif

<div class="table-responsive-sm mt-4">
    <table id="myTable" class="table table-bordered table-hover mt-2 table-striped">
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
            @forelse ($accountlList as $data)
            <tr>
                <td scope="row">{{$loop->iteration}}</td>
                <td>{{$data->name}}</td>
                <td>{{$data->email}}</td>
                <td>{{$data->role}}</td>  
                @if ($data->departement == 'migas')
                    <td>Distribusi Gas ORF</td>
                @else
                    <td>{{$data->departement}}</td>
                @endif
                <td>
                    <a type="button" class="btn btn-sm orangeEdit " 
                        href="showAccount/{{$data->id}}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-clockwise" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M8 3a5 5 0 1 0 4.546 2.914.5.5 0 0 1 .908-.417A6 6 0 1 1 8 2v1z"/>
                            <path d="M8 4.466V.534a.25.25 0 0 1 .41-.192l2.36 1.966c.12.1.12.284 0 .384L8.41 4.658A.25.25 0 0 1 8 4.466z"/>
                            </svg>
                            Reset Password
                    </a>
                    

                    <form action="deleteAccount/{{$data->id}}" method="post">
                        @csrf
                        <div class="mt-2">
                            <button onclick="if (confirm('Yakin Mau Delete Data ? Tindakan ini tidak dapat dikembalikan')){return true;}else{event.stopPropagation(); event.preventDefault();};" class="btn btn-sm redDelete margin-button" type="submit"> <i class="bi bi-trash3-fill"></i> Delete
                            </button>
                        </div>
                    </form>
                </td>
            </tr>
            @empty
            <td colspan="8" class="text-center">
                Tidak ada Data
            </td>
            @endforelse
        </tbody>
    </table>
</div>
@endsection