@extends('layouts.sidebar')
@section('content')

<h1>Stock Masuk {{ucfirst($namaPart)}} (LAMPAU)</h1>

<div class="mt-4 col-8 ">

    <form action="/inventory/plusOldStock/{{$dataId}}" enctype="multipart/form-data" method="POST">
        @csrf
            <div class="form-floating mb-3">
                <input type="date" class="form-control" id="floatingInput" name="dtStockPartApprovedIn" required value="{{old('dtStockPartApprovedIn')}}">
                <label for="floatingInput">Tanggal FTB</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com"  name="noFtb" required>
                <label for="floatingInput">No FTB</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com"  name="nameRequester"
                value="{{old('nameRequester')}}" required>
                <label for="floatingInput">Nama Pemohon</label>
            </div>
            <div class="form-group mb-3">
                                    <label >Departement Pemohon :</label>
                                    <select name="departmentRequester" class="form-select form-control" aria-label="Default select example" required>
                                        <option value="reliability"selected>Dept.Reliability</option>
                                        <option value="layum">Dept.Layanan Umum</option>
                                        <option value="technology">Dept.IT</option>
                                        <option value="sekper">Dept.Sekretaris Perusahaan</option>
                                        <option value="transportasi">Dept.Transportasi LNG & FSRU</option>
                                    </select>
            </div>
            <div class="form-floating mb-3">
                
                <input type="text" class="form-control @error('noPart') is-invalid @enderror" id="floatingInput" placeholder="name@example.com"  name="noPart" required value="{{old('noPart')}}">
                <label for="floatingInput">Nomor Part</label>
                <p style="color: red;font-size:15px">*Nomor Part Tidak Boleh Kosong</p>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com"  name="status"
                value="{{old('status')}}" required>
                <label for="floatingInput">Status Barang</label>
            </div>
            <div class="form-floating mb-3">
                <input type="date" class="form-control" id="floatingInput" name="dtStockPartIn" required value="{{old('dtStockPartIn')}}">
                <label for="floatingInput">Tanggal Pengajuan</label>
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
            <label > Upload TTD User (PNG)</label>
            <div class="form-floating mb-3 col-5">
                <input type="file" class="form-control @error('signatureUser') is-invalid @enderror" style="padding-left: 30px;padding-bottom:30px; padding-top:20px"  placeholder="name@example.com"  name="signatureUser" required>
                @error('signatureUser')
                <div class="invalid-feedback">
                Kesalahan Format foto. Mohon menggunakan format PNG
                </div>
                @enderror
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com"  name="nameHead"
                value="{{old('nameHead')}}" required>
                <label for="floatingInput">Nama Kadept Pemohon</label>
            </div>
            <label > Upload TTD Kadept Pemohon (PNG)</label>
            <div class="form-floating mb-3 col-5">
                <input type="file" class="form-control @error('signatureHead') is-invalid @enderror" style="padding-left: 30px;padding-bottom:30px; padding-top:20px"  placeholder="name@example.com"  name="signatureHead" required>
                @error('signatureHead')
                <div class="invalid-feedback">
                Kesalahan Format foto. Mohon menggunakan format PNG
                </div>
                @enderror
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com"  name="nameHeadProc"
                value="{{old('nameHeadProc')}}" required>
                <label for="floatingInput">Nama Kadept Procurement</label>
            </div>
            <label > Upload TTD Kadept Procurement(PNG)</label>
            <div class="form-floating mb-3 col-5">
                <input type="file" class="form-control @error('signatureMaster') is-invalid @enderror" style="padding-left: 30px;padding-bottom:30px; padding-top:20px"  placeholder="name@example.com"  name="signatureMaster" required>
                @error('signatureMaster')
                <div class="invalid-feedback">
                Kesalahan Format foto. Mohon menggunakan format PNG
                </div>
                @enderror
            </div>
            <div class="mb-3">
                <button class="btn greenAdd"  type="submit">Simpan</button>
            </div>
          
    </form>

</div>


@endsection