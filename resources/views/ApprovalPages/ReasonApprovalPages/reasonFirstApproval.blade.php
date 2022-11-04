@extends('layouts.sidebar')
@section('content')

<form action="/{{$action}}/{{$id}}" enctype="multipart/form-data" method="POST">
        @csrf
    <div class="form-floating mb-3">
        <h3>Halaman Revisi Dokumen</h3>
        <div class="mt-4">
        <h6>Alasan Revisi Dokumen :</h6>
        <div class="form-floating mb-3">
            <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px" 
            name="{{$nameReason}}" 
            required></textarea>
        </div>
    </div>
    <div class="form-group">
        <div class="mb-3">
            <button class="btn greenAdd" type="submit">Kirim</button>
        </div>
    </div>
 </div>
</form>
@endsection