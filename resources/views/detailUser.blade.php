@extends('layouts.sidebarSuperAdmin')
@section('content')
<h2>Reset Password {{$data->name}}</h2>
@if (session()->has('failed'))
    <div class="alert alert-danger" role="alert" id="box">
        <div>{{session('failed')}}</div>
    </div>
@elseif (session()->has('success'))
    <div class="alert greenAdd" role="alert" id="box">
        <div>{{session('success')}}</div>
    </div>
@endif
<form action="/resetPassword/{{$data->id}}" method="POST">
     @csrf
     <div class="col-5">
        <div class="form-group mt-4">
            <label for="password">Create New Password</label>
            <input name="password" type="password" class="form-control" id="password" @error('password')
            is-invalid @enderror" required onkeyup='check();'>
                @error('password')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
        </div>
        <div class="form-group mt-4">
            <label for="password">Confirm Password</label>
            <input name="confirmPassword" type="password" class="form-control @error('password')
            is-invalid @enderror" id="confirm_password" required onkeyup='check();'>
                @error('password')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
            <span id='message'></span>
        </div>
        <div class="form-group mt-2">
            <button type="submit"  id="submit" class="btn greenAdd btn-block mt-3 border-0 mb-5"
            onclick="if (confirm('Yakin Mereset Password Akun ini?')){return true;}else{event.stopPropagation(); event.preventDefault();
            };" style="visibility: hidden;">
                Reset
            </button>
        </div>
    </div>
</form>

<script>
    var check = function() {
    if (document.getElementById('password').value ==document.getElementById('confirm_password').value) {
        document.getElementById('message').style.color = 'green';
        document.getElementById('message').innerHTML = 'matching';
        document.getElementById('submit').style.visibility = 'visible';

    } else {
        document.getElementById('message').style.color = 'red';
        document.getElementById('message').innerHTML = 'not matching';
    }
    }
</script>
@endsection