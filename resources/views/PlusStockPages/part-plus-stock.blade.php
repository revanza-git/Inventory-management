@extends('layouts.sidebar')
@section('content')

<div class="modal" id="myModal" data-bs-backdrop="static" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <img src="{{asset('nr.png')}}" class="rounded" width="200px" style="display: block">
        <button type="button" class="btn-close" data-bs-dismiss="modal" id="closeButton" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <h5>Disclaimer :</h5>
        <p style="font-size: 15px">Kami hanya bertanggung jawab sesuai hasil visual check yang diterima.</p>
      </div>
      <div class="modal-footer">
        <p>Departement Procurement</p>
      </div>
    </div>
  </div>
</div>


<h1>Stock Masuk {{ucfirst($namaPart)}}</h1>

<div class="mt-4 col-8 ">

    <form action="/{{$category}}-plus-stock/{{$dataId}}" enctype="multipart/form-data" method="POST">
        @csrf
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com"  name="noFtb" readonly>
                <label for="floatingInput">No FTB</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com"  name="nameRequester" value="{{auth()->user()->name}}" readonly>
                <label for="floatingInput">Nama Pemohon</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com"  name="departmentRequester" value="{{ucwords(auth()->user()->departement)}}" readonly>
                <label for="floatingInput">Department Pemohon</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com"  name="status"
                value="{{old('status')}}" required>
                <label for="floatingInput">Status Barang</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control @error('noPart') is-invalid @enderror" id="floatingInput" placeholder="name@example.com"  name="noPart" required value="{{old('noPart')}}">
                <label for="floatingInput">Nomor Part</label>
            </div>
            <div class="form-floating mb-3">
                <input type="date" class="form-control" id="floatingInput" name="dtStockPartIn" required value="{{old('dtStockPartIn')}}">
                <label for="floatingInput">Tanggal Masuk</label>
            </div>
            <div class="form-floating mb-3">
                <input type="number" class="form-control @error('qtyStockPartIn') is-invalid @enderror" id="floatingInput" placeholder="name@example.com" min="0" required name="qtyStockPartIn" value="{{old('qtyStockPartIn')}}">
                <label for="floatingInput">Quantity In</label>
            </div>
            <div class="form-floating mb-3">
                <input type="number" class="form-control @error('priceStockPartIn') is-invalid @enderror" id="floatingInput" placeholder="name@example.com" min="0" required name="priceStockPartIn" value="{{old('priceStockPartIn')}}">
                <label for="floatingInput">Harga Satuan</label>
            </div>
            <div class="form-floating mb-3">
                <input type="number" class="form-control @error('yearStockPartIn') is-invalid @enderror" id="floatingInput" placeholder="name@example.com" min="2000" required name="yearStockPartIn" value="{{old('yearStockPartIn')}}">
                <label for="floatingInput">Tahun Perolehan</label>
            </div>
            <label > Upload File Bukti Foto (JPG/PNG/PDF)</label>
            <div class="form-floating mb-3 col-5">
                <input type="file" class="form-control @error('filePhotoPartIn') is-invalid @enderror" style="padding-left: 30px;padding-bottom:30px; padding-top:20px"  placeholder="name@example.com"  name="filePhotoPartIn">
                @error('filePhotoPartIn')
                <div class="invalid-feedback">
                Kesalahan Format foto. Mohon menggunakan format JPG/PNG/PDF
                </div>
                @enderror
            </div>
            <label > Upload File PO (PDF)</label>
            <div class="form-floating mb-3 col-5">
                <input type="file" class="form-control @error('filePO') is-invalid @enderror" style="padding-left: 30px;padding-bottom:30px; padding-top:20px"  placeholder="name@example.com"  name="filePO">
                @error('filePO')
                <div class="invalid-feedback">
                Kesalahan Format PO. Mohon menggunakan format PDF
                </div>
                @enderror
            </div>
            <label > Upload File BAST (PDF)</label>
            <div class="form-floating mb-3 col-5">
                <input type="file" class="form-control @error('fileBAST') is-invalid @enderror" style="padding-left: 30px;padding-bottom:30px; padding-top:20px"  placeholder="name@example.com"  name="fileBAST">
                @error('fileBAST')
                <div class="invalid-feedback">
                Kesalahan Format BAST. Mohon menggunakan format PDF
                </div>
                @enderror
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com"  name="needsStockPartIn"
                value="{{old('needsStockPartIn')}}" required>
                <label for="floatingInput">Keperluan</label>
            </div>
            <div class="form-floating mb-3">
                <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px" 
                name="notesPartIn" 
                required>{{old('notesPartIn')}}</textarea>
                <label for="floatingTextarea2">Keterangan</label>
            </div>
            <div class="mb-3">
                <button class="btn greenAdd"  type="submit">Simpan</button>
            </div>
          
    </form>

</div>

<script type="text/javascript">
    $(window).on('load', function(){
        $("#myModal").modal('show');
        $("#closeButton").on('click', function(){
            $("#myModal").modal('hide');
        })
    });

</script>

@endsection