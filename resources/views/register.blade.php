@extends('layouts.sidebarSuperAdmin')
@section('content')
<h1>Halaman Registrasi</h1>
@if (session()->has('failed'))
    <div class="alert alert-danger" role="alert" id="box">
        <div>{{session('failed')}}</div>
    </div>
@elseif (session()->has('success'))
    <div class="alert greenAdd" role="alert" id="box">
        <div>{{session('success')}}</div>
    </div>
@endif

                <form action="/register"  enctype="multipart/form-data" method="POST">
                            @csrf
                            <div class="mt-2">
                                <div class="form-group">
                                    <label for="mail">Nama Lengkap</label>
                                    <input name="name" type="text" class="form-control @error('name')
                                    is-invalid @enderror" required value="{{old('name')}}"></input>
                                    @error('name')
                                    <div class="invalid-feedback">
                                       {{$message}}
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group mt-2">
                                    <label for="mail">Email</label>
                                    <input name="email" type="text" class="form-control @error('email')
                                    is-invalid @enderror" required value="{{old('email')}}"></input>
                                    @error('email')
                                    <div class="invalid-feedback">
                                       {{$message}}
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group mt-2">
                                    <label for="password">Create New Password</label>
                                    <input name="password" type="password" class="form-control @error('password')
                                    is-invalid @enderror" required>
                                    @error('password')
                                    <div class="invalid-feedback">
                                       {{$message}}
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group mt-2">
                                    <label >Role</label>
                                    <select name="role" class="form-select form-control" aria-label="Default select example" required  >
                                        <option value="user"selected>User</option>
                                        <option value="admin">Admin</option>
                                        <option value="head">Head Of</option>
                                        <option value="master">Master Of</option>
                                    </select>
                                </div>
                                <div class="form-group mt-2">
                                    <label >Departement</label>
                                    <select name="departement" class="form-select form-control" aria-label="Default select example" required>
                                        <option value="reliability"selected>Dept.Reliability</option>
                                        <option value="layum">Dept.Layanan Umum</option>
                                        <option value="technology">Dept.IT</option>
                                        <option value="sekper">Dept.Sekretaris Perusahaan</option>
                                        <option value="procurement">Dept.Procurement</option>
                                    </select>
                                </div>
                                <label class="mt-3">Tanda Tangan/Paraf (PNG)</label>
                                <p style="color: red; font-size:14px;">*Wajib Untuk Pengguna Sistem kecuali Super Admin</p>
                                <div class="form-floating mb-3 col-5">
                                    <input type="file" class="form-control @error('signature') is-invalid @enderror" style="padding-left: 30px;padding-bottom:30px; padding-top:20px"  placeholder="name@example.com"  name="signature">
                                    @error('signature')
                                    <div class="invalid-feedback">
                                    Kesalahan Format Tanda Tangan. Mohon menggunakan format PNG
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group mt-2">
                                    <label class="">Secret Password</label>
                                    <input name="secPassword" type="password" class="form-control" required></div>
                                </div>
                                <div class="form-group mt-2">
                                    <button type="submit" class="btn greenAdd btn-block mt-3 border-0 mb-5">
                                        Register
                                    </button>
                                </div>
                            </div>
            </form> 
@endsection