@extends('layouts.sidebar')

@section('content')

<h1>Edit data {{$data->noPart}}</h1>

<div class="mt-4 col-8 ">
    {{-- {{dd($data)}} --}}
    <form action="/inventory/flowIn{{$category}}/{{$data->id_flowInPart}}" enctype="multipart/form-data" method="POST">
        @method('PUT')
        @csrf
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
            @if (auth()->user()->role =='admin')
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com"  name="noFtb" 
                value="{{$data->noFtb}}">
                <label for="floatingInput">No FTB</label>
            </div>
            @else
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com"  name="noFtb" value="{{$data->noFtb}}" disabled>
                <label for="floatingInput">No FTB</label>
            </div>
            @endif
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com"  name="noPart" value="{{$data->noPart}}" required>
                <label for="floatingInput">No Part </label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com"  name="status"
                value="{{$data->status}}">
                <label for="floatingInput">Status Barang</label>
            </div>
            <div class="form-floating mb-3">
                <input type="date" class="form-control" id="floatingInput" name="dtStockPartIn" required value="{{$data->dtStockPartIn}}">
                <label for="floatingInput">Tanggal Masuk</label>
            </div>
            <div class="form-floating mb-3">
                <input type="number" class="form-control" id="floatingInput" placeholder="name@example.com" min="0" required name="qtyStockPartIn"
                value="{{$data->qtyStockPartIn}}">
                <label for="floatingInput">Quantity In</label>
            </div>
            <div class="form-floating mb-3">
                <input type="number" class="form-control" id="floatingInput" placeholder="name@example.com" min="0" required name="priceStockPartIn" value="{{$data->priceStockPartIn}}">
                <label for="floatingInput">Harga Satuan</label>
            </div>
            <div class="form-floating mb-3">
                <input type="number" class="form-control" id="floatingInput" placeholder="name@example.com" min="2000" required name="yearStockPartIn" value="{{$data->yearStockPartIn}}">
                <label for="floatingInput">Tahun Perolehan</label>
            </div>
            <label > Upload File Bukti Foto (JPG/PNG)</label>
            <p>File Foto Sebelumnya : {{$data->filePhotoPartIn}}</p>
            <div class="form-floating mb-3 col-5">
                <input type="file" class="form-control" style="padding-left: 30px;padding-bottom:30px; padding-top:20px"  placeholder="name@example.com"  name="filePhotoPartIn"
                value="{{$data->filePhotoPartIn}}">
            </div>
            <label > Upload File PO (PDF)</label>
            <p>File PO Sebelumnya : {{$data->filePO}}</p>
            <div class="form-floating mb-3 col-5">
                <input type="file" class="form-control" style="padding-left: 30px;padding-bottom:30px; padding-top:20px"  placeholder="name@example.com"  name="filePO">
            </div>
            <label > Upload File BAST (PDF)</label>
            <p>File BAST Sebelumnya : {{$data->fileBAST}}</p>
            <div class="form-floating mb-3 col-5">
                <input type="file" class="form-control" style="padding-left: 30px;padding-bottom:30px; padding-top:20px"  placeholder="name@example.com" name="fileBAST">
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com"  name="needsStockPartIn"
                value="{{$data->needsStockPartIn}}">
                <label for="floatingInput">Keperluan</label>
            </div>
            <div class="form-floating mb-3">
                <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px" 
                name="notesPartIn"
                >{{$data->notesPartIn}}</textarea>
                <label for="floatingTextarea2">Keterangan</label>
            </div> 
            <div class="mb-3">
                <button class="btn greenAdd"  type="submit">Simpan</button>
            </div> 

    </form>

</div>

@endsection