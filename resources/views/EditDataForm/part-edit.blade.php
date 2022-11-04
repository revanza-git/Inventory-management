@extends('layouts.sidebar')

@section('content')
{{-- {{dd($data);}} --}}
<h1>Edit {{$data->namaPart}}</h1>

<div class="mt-4 col-8 ">

    <form action="/{{$category}}/{{$data->idPart}}" method="POST">
        @method('PUT')
        @csrf
            <div class="form-floating mb-3">
                <input type="text" class="form-control @error('namaPart') is-invalid @enderror" id="floatingInput" placeholder="name@example.com"  name="namaPart" 
                value="{{$data->namaPart}}">
                <label for="floatingInput">Nama Part</label>
                @error('namaPart')
                <div class="invalid-feedback">
                Mohon maaf, nama part tidak boleh kosong !
                </div>
                @enderror
            </div>
            <div class="form-floating mb-3">
                <textarea class="form-control @error('descPart') is-invalid @enderror" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px" 
                name="descPart" 
                >{{$data->descPart}}</textarea>
                <label for="floatingTextarea2">Deskripsi Spesifikasi</label>
                @error('descPart')
                <div class="invalid-feedback">
                Mohon maaf, deskripsi part tidak boleh kosong !
                </div>
                @enderror
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control @error('lokasiPart') is-invalid @enderror" id="floatingInput" placeholder="nomor Part" name="lokasiPart" 
                value="{{$data->lokasiPart}}">
                <label for="floatingInput">Lokasi Gudang</label>
                @error('lokasiPart')
                <div class="invalid-feedback">
                Mohon maaf, lokasi part tidak boleh kosong !
                </div>
                @enderror
            </div>
            @if(!is_null($data->size))
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com"  name="size" type="text" value="{{$data->size}}">
                <label for="floatingInput">Size</label>
            </div>
            @endif
            <div class="mb-3">
                <label for="floatingInput">Satuan</label>
               <input type="text" class="form-control  @error('satuanPart') is-invalid @enderror" id="floatingInput" placeholder="Satuan"  name="satuanPart" 
                value="{{$data->satuanPart}}" oninput="this.value = this.value.toUpperCase()">
                @error('lokasiPart')
                <div class="invalid-feedback">
                Mohon maaf, satuan part tidak boleh kosong !
                </div>
                @enderror
            </div>
            <div class="form-floating mb-3">
                <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px" 
                name="keterangan">{{$data->keterangan}}</textarea>
                <label for="floatingTextarea2">Keterangan</label>
            </div>
            <div class="mb-3">
                <button class="btn greenAdd" type="submit">Update Data</button>
            </div>

    </form>

</div>
@endsection