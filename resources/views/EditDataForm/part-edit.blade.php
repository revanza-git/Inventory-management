@extends('layouts.sidebar')

@section('content')
{{-- {{dd($data);}} --}}
<h1>Edit {{$data->namaPart}}</h1>

<div class="mt-4 col-8 ">

    <form action="/inventory/{{$category}}/{{$data->idPart}}" method="POST">
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
                <select name="kategoriMaterial" class="form-select form-control" aria-label="Default select example" id="dropdown">
                    <option value="stock">Stock</option>
                    <option value="surplus">Surplus Proyek</option>
                    <option value="dead">Dead Stock</option>
                    <option value="rongsokan">Rongsokan</option>
                    <option value="charges">Direct Charges</option>
                </select>
                <label for="dropdown">Kategori Material</label>
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
                <select name="lokasiPart" class="form-select form-control" aria-label="Default select example" id="dropdown">
                    <option value="Gudang Sunter" selected>Gudang Sunter</option>
                    <option value="Gudang Orf" selected>Gudang ORF</option>
                </select>
                <label for="dropdown">Lokasi</label>
            </div>

            @if(!is_null($data->size))
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com"  name="size" type="text" value="{{$data->size}}">
                <label for="floatingInput">Size</label>
            </div>
            @endif

            <div class="form-floating mb-3">
                <select name="satuanPart" class="form-select form-control" aria-label="Default select example" id="dropdown">
                    <option value="EA"selected>EA</option>
                    <option value="SET">SET</option>
                    <option value="PCS">PCS</option>
                    <option value="ROLL">ROLL</option>
                    <option value="M">M</option>
                    <option value="LOT">LOT</option>
                    <option value="BOX">BOX</option>
                </select>
                <label for="dropdown">Satuan</label>
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