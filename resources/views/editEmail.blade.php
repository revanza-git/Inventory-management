@extends('layouts.sidebarSuperAdmin')
@section('content')
<h2>Edit Email {{$data->name}}</h2>
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
            <label for="email">New Email</label>
            <input name="email" type="text" id="email" class="form-control @error('email')
            is-invalid @enderror" required value="{{ $data->email }}" onkeyup='check();'>
                @error('email')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
        </div>
        
        <div class="form-group mt-2">
            <button type="submit"  id="submit" class="btn greenAdd btn-block mt-3 border-0 mb-5"
            onclick="if (confirm('Yakin Mereset email Akun ini?')){return true;}else{event.stopPropagation(); event.preventDefault();
            };">
                Update
            </button>
        </div>
    </div>
</form>

@endsection