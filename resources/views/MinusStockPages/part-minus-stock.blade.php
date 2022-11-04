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

<h1>Stock Keluar {{$namaPart}}</h1>

<div class="mt-4 col-8 ">

    <form action="/{{$category}}-minus-stock/{{$dataId}}" enctype="multipart/form-data" method="POST">
        @csrf

            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com"  name="noFkb" readonly>
                <label for="floatingInput">No FKB</label>
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
            @if (count($dataIn)==1)
                <label >No Part</label>
                @foreach ($dataIn as $singleData)
                <div class="mb-3">
                    <input type="text" class="form-control"  placeholder="No Part" min="0" required name="noPart"   
                    value="{{$singleData->noPart}}" readonly> 
                </div>
                <label >Harga Satuan</label>
                <div class="mb-3">
                    <input type="number" class="form-control"  placeholder="harga Satuan" min="0" required name="priceStockPartOut"   
                    value="{{$singleData->priceStockPartIn}}" readonly> 
                </div>
                <label >Tahun Perolehan</label>
                <div class="mb-3">
                    <input type="number" class="form-control"  placeholder="Tahun Perolehan" min="0" required name="yearStockPartOut" 
                    value="{{$singleData->yearStockPartIn}}" readonly> 
                </div>
            @endforeach
            @else
                <label >Nomor Part</label>
                <div class="mb-3">
                    <select id="selector" name="noPart" class="form-select form-control" aria-label="Default select example" onchange="changeValue(this.value)">
                        @foreach ($dataIn as $dataNoPart)
                        <option value="{{$dataNoPart->noPart}}">{{$dataNoPart->noPart }}</option>  
                        @endforeach
                    </select>
                </div>
                <label >Harga Satuan</label>
                <div class="mb-3">
                    <input type="number" class="form-control @error('priceStockPartOut') is-invalid @enderror" id="price" placeholder="harga Satuan" min="0" required name="priceStockPartOut"  readonly> 
                </div>
                <label >Tahun Perolehan</label>
                <div class="mb-3">
                    <input type="number" class="form-control @error('yearStockPartOut') is-invalid @enderror" id="year" placeholder="Tahun Perolehan" min="0" required name="yearStockPartOut"  readonly> 
                </div>
            @endif
            <div class="form-floating mb-3">
                <input type="date" class="form-control @error('dtStockPartOut') is-invalid @enderror" id="floatingInput" name="dtStockPartOut" required 
                value="{{old('dtStockPartOut')}}">
                <label for="floatingInput">Tanggal Keluar</label>
            </div>
            <div class="form-floating mb-3">
                <input type="number" class="form-control @error('qtyStockPartOut') is-invalid @enderror" id="floatingInput" placeholder="name@example.com" min="0" required name="qtyStockPartOut" value="{{old('qtyStockPartOut')}}">
                <label for="floatingInput">Quantity Out</label>
            </div>
            
            <label > Upload File Bukti Foto (JPG/PNG/PDF)</label>
            <div class="form-floating mb-3 col-5">
                <input type="file" class="form-control @error('filePhotoPartOut') is-invalid @enderror" style="padding-left: 30px;padding-bottom:30px; padding-top:20px"  placeholder="name@example.com" name="filePhotoPartOut">
                @error('filePhotoPartOut')
                <div class="invalid-feedback">
                Kesalahan Format foto. Mohon menggunakan format JPG/PNG/PDF
                </div>
                @enderror
            </div>
            <label > Upload File Lainnya (PDF)</label>
            <div class="form-floating mb-3 col-5">
                <input type="file" class="form-control @error('filePO') is-invalid @enderror" style="padding-left: 30px;padding-bottom:30px; padding-top:20px"  placeholder="name@example.com" name="filePO">
                @error('filePO')
                <div class="invalid-feedback">
                Kesalahan Format file. Mohon menggunakan format PDF
                </div>
                @enderror
            </div>
            <label > Upload File Lainnya (PDF)</label>
            <div class="form-floating mb-3 col-5">
                <input type="file" class="form-control @error('fileBAST') is-invalid @enderror" style="padding-left: 30px;padding-bottom:30px; padding-top:20px"  placeholder="name@example.com"  name="fileBAST">
                @error('fileBAST')
                <div class="invalid-feedback">
                Kesalahan Format file. Mohon menggunakan format PDF
                </div>
                @enderror
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com"  name="needsStockPartOut"
                value="{{old('needsStockPartOut')}}">
                <label for="floatingInput">Keperluan</label>
            </div>
            <div class="form-floating mb-3">
                <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px" 
                name="notesPartOut"
                required>{{old('notesPartOut')}}</textarea>
                <label for="floatingTextarea2">Keterangan</label>
            </div>
            
            <div class="mb-3">
                <button class="btn greenAdd"  type="submit">Simpan</button>
            </div>
          
    </form>

</div>
<script>
function changeValue(value) { 
    fetch('/part-minus-findData/'+value)
    .then(function(response) {
        return response.json();
    })
    .then(function(data) {
        console.log(data[0].priceStockPartIn);
        document.getElementById('price').value = data[0].priceStockPartIn;
        document.getElementById('year').value = data[0].yearStockPartIn;
    });
  
}
 $(window).on('load', function(){
        $("#myModal").modal('show');
        $("#closeButton").on('click', function(){
            $("#myModal").modal('hide');
        })
    });
</script>
@endsection