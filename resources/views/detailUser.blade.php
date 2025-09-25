@extends('layouts.sidebarSuperAdmin')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Detail Pengguna</h2>
            <a href="/inventory/listUsers" class="btn btn-secondary">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
                </svg>
                Kembali ke Daftar
            </a>
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
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Informasi Pengguna</h5>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label font-weight-bold">Nama Lengkap:</label>
                    <div class="col-sm-9">
                        <p class="form-control-plaintext">{{$data->name}}</p>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label font-weight-bold">Email / Username:</label>
                    <div class="col-sm-9">
                        <p class="form-control-plaintext">{{$data->email}}</p>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label font-weight-bold">Role:</label>
                    <div class="col-sm-9">
                        <p class="form-control-plaintext">
                            @if($data->role == 'superadmin')
                                <span class="badge bg-danger badge-lg">Super Admin</span>
                            @elseif($data->role == 'master')
                                <span class="badge bg-warning badge-lg">Master</span>
                            @elseif($data->role == 'admin')
                                <span class="badge bg-primary badge-lg">Admin</span>
                            @elseif($data->role == 'head')
                                <span class="badge bg-info badge-lg">Head</span>
                            @else
                                <span class="badge bg-secondary badge-lg">User</span>
                            @endif
                        </p>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label font-weight-bold">Departemen:</label>
                    <div class="col-sm-9">
                        <p class="form-control-plaintext">
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
                        </p>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label font-weight-bold">User ID:</label>
                    <div class="col-sm-9">
                        <p class="form-control-plaintext">#{{$data->id}}</p>
                    </div>
                </div>
                @if($data->signature)
                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label font-weight-bold">Digital Signature:</label>
                    <div class="col-sm-9">
                        <p class="form-control-plaintext">
                            <span class="badge bg-success">✓ Available</span>
                            <small class="text-muted d-block">{{$data->signature}}</small>
                        </p>
                    </div>
                </div>
                @else
                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label font-weight-bold">Digital Signature:</label>
                    <div class="col-sm-9">
                        <p class="form-control-plaintext">
                            <span class="badge bg-warning">Not Available</span>
                        </p>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
    
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Aksi Pengelolaan</h5>
            </div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    <a href="/inventory/editEmail/{{$data->id}}" class="btn btn-warning">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-envelope-gear" viewBox="0 0 16 16">
                            <path d="M2 2a2 2 0 0 0-2 2v8.01A2 2 0 0 0 2 14h5.5a.5.5 0 0 0 0-1H2a1 1 0 0 1-.966-.741l5.64-3.471L8 9.583l7-4.2V8.5a.5.5 0 0 0 1 0V4a2 2 0 0 0-2-2H2Zm3.708 6.208L1 11.105V5.383l4.708 2.825ZM1 4.217V4a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v.217l-7 4.2-7-4.2Z"/>
                            <path d="M11.5 9a3.5 3.5 0 1 0 0 7 3.5 3.5 0 0 0 0-7ZM8 12.5a3.5 3.5 0 1 1 .5-.027V13.5a.5.5 0 0 1-.5.5h-.5a.5.5 0 0 1 0-1H8v-.5ZM10.5 13a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1h-2Z"/>
                        </svg>
                        Edit Email
                    </a>
                    
                    <button class="btn btn-primary" data-toggle="modal" data-target="#resetPasswordModal">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-key" viewBox="0 0 16 16">
                            <path d="M0 8a4 4 0 0 1 7.465-2H14a.5.5 0 0 1 .354.146l1.5 1.5a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0L13 9.207l-.646.647a.5.5 0 0 1-.708 0L11 9.207l-.646.647a.5.5 0 0 1-.708 0L9 9.207l-.646.647A.5.5 0 0 1 8 10h-.535A4 4 0 0 1 0 8zm4-3a3 3 0 1 0 2.712 4.285A.5.5 0 0 1 7.163 9h.63l.853-.854a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.793-.793-1-1h-6.63a.5.5 0 0 1-.451-.285A3 3 0 0 0 4 5z"/>
                            <path d="M4 8a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
                        </svg>
                        Reset Password
                    </button>
                    
                    <hr>
                    
                    <button class="btn btn-danger" data-toggle="modal" data-target="#deleteUserModal">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                            <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84L14.462 3.5H15a.5.5 0 0 0 0-1h-4.5Z"/>
                            <path d="M4.12 4.251A.5.5 0 0 1 4.5 4h7a.5.5 0 0 1 .48.641l-.83 10.39a1 1 0 0 1-.997.859H4.847a1 1 0 0 1-.997-.859l-.83-10.39A.5.5 0 0 1 4.12 4.251Z"/>
                        </svg>
                        Delete User
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Reset Password Modal -->
<div class="modal fade" id="resetPasswordModal" tabindex="-1" aria-labelledby="resetPasswordModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="resetPasswordModalLabel">Reset Password - {{$data->name}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/inventory/resetPassword/{{$data->id}}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <label for="password" class="form-label mb-0">Password Baru</label>
                            <button type="button" class="btn btn-outline-primary btn-sm" onclick="generateRandomPassword()">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-shuffle" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M0 3.5A.5.5 0 0 1 .5 3H1c2.202 0 3.827 1.24 4.874 2.418.49.552.865 1.102 1.126 1.532.26-.43.636-.98 1.126-1.532C9.173 4.24 10.798 3 13 3v1c-1.798 0-3.173 1.01-4.126 2.082A9.624 9.624 0 0 0 7.556 8a9.624 9.624 0 0 0 1.318 1.918C9.827 10.99 11.202 12 13 12v1c-2.202 0-3.827-1.24-4.874-2.418A10.595 10.595 0 0 1 7 9.05c-.26.43-.636.98-1.126 1.532C4.827 11.76 3.202 13 1 13H.5a.5.5 0 0 1 0-1H1c1.798 0 3.173-1.01 4.126-2.082A9.624 9.624 0 0 0 6.444 8a9.624 9.624 0 0 0-1.318-1.918C4.173 5.01 2.798 4 1 4H.5a.5.5 0 0 1-.5-.5z"/>
                                    <path d="M13 5.466V1.534a.25.25 0 0 1 .41-.192l2.36 1.966c.12.1.12.284 0 .384l-2.36 1.966a.25.25 0 0 1-.41-.192zm0 9v-3.932a.25.25 0 0 1 .41-.192l2.36 1.966c.12.1.12.284 0 .384l-2.36 1.966a.25.25 0 0 1-.41-.192z"/>
                                </svg>
                                Generate Safe Password
                            </button>
                        </div>
                        <div class="input-group">
                            <input name="password" type="password" class="form-control @error('password') is-invalid @enderror" id="password" required onkeyup='check();' placeholder="Enter new password">
                            <button class="btn btn-outline-secondary" type="button" onclick="togglePassword('password', this)">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                    <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                                    <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
                                </svg>
                            </button>
                        </div>
                        @error('password')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="confirmPassword" class="form-label">Konfirmasi Password</label>
                        <div class="input-group">
                            <input name="confirmPassword" type="password" class="form-control @error('confirmPassword') is-invalid @enderror" id="confirm_password" required onkeyup='check();' placeholder="Confirm new password">
                            <button class="btn btn-outline-secondary" type="button" onclick="togglePassword('confirm_password', this)">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                    <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                                    <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
                                </svg>
                            </button>
                        </div>
                        @error('confirmPassword')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                        <span id='message'></span>
                    </div>
                    <div class="alert alert-info">
                        <small>
                            <strong>Password Requirements:</strong>
                            <ul class="mb-0 mt-1">
                                <li>Minimum 6 characters</li>
                                <li>Contains uppercase & lowercase letters</li>
                                <li>Contains numbers & special characters</li>
                            </ul>
                        </small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" id="submit" class="btn btn-primary" style="visibility: hidden;">Reset Password</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Delete User Modal -->
<div class="modal fade" id="deleteUserModal" tabindex="-1" aria-labelledby="deleteUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteUserModalLabel">Hapus Pengguna</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="alert alert-warning">
                    <strong>Peringatan!</strong> Tindakan ini tidak dapat dibatalkan.
                </div>
                <p>Apakah Anda yakin ingin menghapus pengguna <strong>{{$data->name}}</strong>?</p>
                <ul class="text-muted">
                    <li>Semua data terkait pengguna akan terhapus</li>
                    <li>Pengguna tidak akan bisa login lagi</li>
                    <li>Tindakan ini tidak dapat dikembalikan</li>
                </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <form action="/inventory/deleteAccount/{{$data->id}}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" class="btn btn-danger">Hapus Pengguna</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    // Password matching checker
    var check = function() {
        if (document.getElementById('password').value == document.getElementById('confirm_password').value) {
            document.getElementById('message').style.color = 'green';
            document.getElementById('message').innerHTML = '✓ Password cocok';
            document.getElementById('submit').style.visibility = 'visible';
        } else {
            document.getElementById('message').style.color = 'red';
            document.getElementById('message').innerHTML = '✗ Password tidak cocok';
            document.getElementById('submit').style.visibility = 'hidden';
        }
    }

    // Generate random secure password
    function generateRandomPassword() {
        const length = 12; // Password length
        const uppercase = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        const lowercase = 'abcdefghijklmnopqrstuvwxyz';
        const numbers = '0123456789';
        const symbols = '!@#$%^&*()_+-=[]{}|;:,.<>?';
        
        let password = '';
        
        // Ensure password contains at least one character from each category
        password += uppercase.charAt(Math.floor(Math.random() * uppercase.length));
        password += lowercase.charAt(Math.floor(Math.random() * lowercase.length));
        password += numbers.charAt(Math.floor(Math.random() * numbers.length));
        password += symbols.charAt(Math.floor(Math.random() * symbols.length));
        
        // Fill the rest of the password
        const allChars = uppercase + lowercase + numbers + symbols;
        for (let i = password.length; i < length; i++) {
            password += allChars.charAt(Math.floor(Math.random() * allChars.length));
        }
        
        // Shuffle the password to randomize the order
        password = password.split('').sort(() => Math.random() - 0.5).join('');
        
        // Fill both password fields
        document.getElementById('password').value = password;
        document.getElementById('confirm_password').value = password;
        
        // Show the password fields temporarily so user can see what was generated
        const passwordField = document.getElementById('password');
        const confirmField = document.getElementById('confirm_password');
        
        passwordField.type = 'text';
        confirmField.type = 'text';
        
        // Update the eye icons to show they are visible
        updateEyeIcon('password', true);
        updateEyeIcon('confirm_password', true);
        
        // Run the check function to validate matching
        check();
        
        // Show success message
        document.getElementById('message').style.color = 'green';
        document.getElementById('message').innerHTML = '✓ Secure password generated and filled!';
        
        // Auto-hide the passwords after 5 seconds for security
        setTimeout(() => {
            if (passwordField.type === 'text') passwordField.type = 'password';
            if (confirmField.type === 'text') confirmField.type = 'password';
            updateEyeIcon('password', false);
            updateEyeIcon('confirm_password', false);
        }, 5000);
    }

    // Toggle password visibility
    function togglePassword(inputId, button) {
        const input = document.getElementById(inputId);
        const isVisible = input.type === 'text';
        
        input.type = isVisible ? 'password' : 'text';
        updateEyeIcon(inputId, !isVisible);
    }

    // Update eye icon based on visibility
    function updateEyeIcon(inputId, isVisible) {
        const button = document.querySelector(`button[onclick*="${inputId}"]`);
        const icon = button.querySelector('svg');
        
        if (isVisible) {
            // Eye-slash icon (hide)
            icon.innerHTML = `
                <path d="m10.79 12.912-1.614-1.615a3.5 3.5 0 0 1-4.474-4.474l-2.06-2.06C.938 6.278 0 8 0 8s3 5.5 8 5.5a7.029 7.029 0 0 0 2.79-.588zM5.21 3.088A7.028 7.028 0 0 1 8 2.5c5 0 8 5.5 8 5.5s-.939 1.721-2.641 3.238l-2.062-2.062a3.5 3.5 0 0 0-4.474-4.474L5.21 3.089z"/>
                <path d="M5.525 7.646a2.5 2.5 0 0 0 2.829 2.829l-2.83-2.829zm4.95.708-2.829-2.83a2.5 2.5 0 0 1 2.829 2.829zm3.171 6-12-12 .708-.708 12 12-.708.708z"/>
            `;
        } else {
            // Eye icon (show)
            icon.innerHTML = `
                <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
            `;
        }
    }
</script>

@endsection