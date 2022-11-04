@extends('layouts.sidebar')

@section('content')

<h1>Edit data {{$data->noPart}}</h1>

<div class="mt-4 col-8 ">
    {{-- {{dd($data)}} --}}
    <form action="/flowOut{{$category}}/{{$data->id_flowOutPart}}" enctype="multipart/form-data" method="POST">
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
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com"  name="noFtb"readonly>
                <label for="floatingInput">No FTB</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com"  name="noPart" value="{{$data->noPart}}" readonly>
                <label for="floatingInput">No Part</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com"  name="status"
                value="{{$data->status}}">
                <label for="floatingInput">Status Barang</label>
            </div>
            <div class="form-floating mb-3">
                <input type="date" class="form-control" id="floatingInput" name="dtStockPartOut" required value="{{$data->dtStockPartOut}}">
                <label for="floatingInput">Tanggal Keluar</label>
            </div>
            <div class="form-floating mb-3">
                <input type="number" class="form-control" id="floatingInput" placeholder="name@example.com" min="0" required name="qtyStockPartOut"
                value="{{$data->qtyStockPartOut}}">
                <label for="floatingInput">Quantity Out</label>
            </div>
            <div class="form-floating mb-3">
                <input type="number" class="form-control" id="floatingInput" placeholder="name@example.com" min="0" required name="priceStockPartOut" value="{{$data->priceStockPartOut}}" readonly>
                <label for="floatingInput">Harga Satuan</label>
            </div>
            <div class="form-floating mb-3">
                <input type="number" class="form-control" id="floatingInput" placeholder="name@example.com" min="2000" required name="yearStockPartOut" value="{{$data->yearStockPartOut}}" readonly>
                <label for="floatingInput">Tahun Perolehan</label>
            </div>
            <label > Upload File Bukti Foto (JPG/PNG)</label>
            <p>File Foto Sebelumnya : {{$data->filePhotoPartOut}}</p>
            <div class="form-floating mb-3 col-5">
                <input type="file" class="form-control" style="padding-left: 30px;padding-bottom:30px; padding-top:20px"  placeholder="name@example.com"  name="filePhotoPartOut"
               >
            </div>
            <label > Upload File Lainnya (PDF)</label>
            <p>File Lainnya Sebelumnya : {{$data->filePO}}</p>
            <div class="form-floating mb-3 col-5">
                <input type="file" class="form-control" style="padding-left: 30px;padding-bottom:30px; padding-top:20px"  placeholder="name@example.com"  name="filePO">
            </div>
            <label > Upload File Lainnya (PDF)</label>
            <p>File Lainnya  Sebelumnya : {{$data->fileBAST}}</p>
            <div class="form-floating mb-3 col-5">
                <input type="file" class="form-control" style="padding-left: 30px;padding-bottom:30px; padding-top:20px"  placeholder="name@example.com" name="fileBAST">
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com"  name="needsStockPartOut"
                value="{{$data->needsStockPartOut}}">
                <label for="floatingInput">Keperluan</label>
            </div>
            <div class="form-floating mb-3">
                <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px" 
                name="notesPartOut"
                required
                >{{$data->notesPartOut}}</textarea>
                <label for="floatingTextarea2">Keterangan</label>
            </div> 

            
            <div class="mb-3">
                <button class="btn greenAdd"  type="submit">Simpan</button>
            </div> 

    </form>

</div>

@endsection