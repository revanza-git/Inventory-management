@extends('layouts.sidebarSuperAdmin')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Edit Email {{$data->name}}</h2>
            <div>
                <a href="/inventory/showAccount/{{$data->id}}" class="btn btn-outline-secondary me-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
                    </svg>
                    Back to User Detail
                </a>
                <a href="/inventory/listUsers" class="btn btn-secondary">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-list-ul" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M5 11.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zm-3 1a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm0 4a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm0 4a1 1 0 1 0 0-2 1 1 0 0 0 0 2z"/>
                    </svg>
                    User List
                </a>
            </div>
        </div>
    </div>
</div>

@if (session()->has('failed'))
    <div class="alert alert-danger" role="alert" id="box">
        <div>{{session('failed')}}</div>
    </div>
@elseif (session()->has('success'))
    <div class="alert greenAdd" role="alert" id="box">
        <div>{{session('success')}}</div>
    </div>
@endif
<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Update Email Address</h5>
            </div>
            <div class="card-body">
                <form action="/inventory/resetPassword/{{$data->id}}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="email" class="form-label">New Email Address</label>
                        <input name="email" type="email" id="email" class="form-control @error('email') is-invalid @enderror" 
                               required value="{{ $data->email }}" placeholder="Enter new email address">
                        @error('email')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                        <div class="form-text">This will be the new login email for the user.</div>
                    </div>
                    
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="/inventory/showAccount/{{$data->id}}" class="btn btn-secondary me-md-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                <path d="m10.97 4.97-.02.022-3.473 4.425-2.093-2.094a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z"/>
                            </svg>
                            Cancel
                        </a>
                        <button type="submit" class="btn btn-success"
                                onclick="if (confirm('Are you sure you want to update this email address?')){return true;}else{event.stopPropagation(); event.preventDefault();};">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-circle" viewBox="0 0 16 16">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                <path d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z"/>
                            </svg>
                            Update Email
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Current User Information</h5>
            </div>
            <div class="card-body">
                <div class="mb-2">
                    <strong>Name:</strong> {{$data->name}}
                </div>
                <div class="mb-2">
                    <strong>Current Email:</strong> {{$data->email}}
                </div>
                <div class="mb-2">
                    <strong>Role:</strong> 
                    @if($data->role == 'superadmin')
                        <span class="badge bg-danger">Super Admin</span>
                    @elseif($data->role == 'master')
                        <span class="badge bg-warning">Master</span>
                    @elseif($data->role == 'admin')
                        <span class="badge bg-primary">Admin</span>
                    @elseif($data->role == 'head')
                        <span class="badge bg-info">Head</span>
                    @else
                        <span class="badge bg-secondary">User</span>
                    @endif
                </div>
                <div class="mb-2">
                    <strong>Department:</strong> 
                    @if ($data->departement == 'reliability')
                        Reliability
                    @elseif ($data->departement == 'layum')
                        Layanan Umum
                    @elseif ($data->departement == 'technology')
                        IT
                    @elseif ($data->departement == 'sekper')
                        Sekretaris Perusahaan
                    @elseif ($data->departement == 'procurement')
                        Procurement
                    @elseif ($data->departement == 'hsse')
                        HSSE
                    @elseif ($data->departement == 'migas')
                        Distribusi Gas dan Manajemen ORF
                    @elseif ($data->departement == 'transportasi')
                        Transportasi LNG & Operasional FSRU
                    @elseif ($data->departement == 'bisnis')
                        Perencanaan & Pengembangan Bisnis
                    @else
                        {{$data->departement}}
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@endsection