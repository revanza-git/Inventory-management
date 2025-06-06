@extends('layouts.sidebar')
@section('content')

@if (session()->has('success'))
    <div class="alert greenAdd" role="alert" id="box">
        <div>{{session('success')}}</div>
    </div>
@endif
<div class="mt-4 col-7 ">
<h2>Tambah Barang</h2>
</div>

<div class="mt-4 col-8 ">

    <form action="part-postNewData" method="POST">
        @csrf
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com"  name="namaPart" type="text" required>
                <label for="floatingInput">Nama Part</label>
            </div>
            
            <div class="form-floating mb-3">
                <select name="kategoriMaterial" class="form-select form-control" aria-label="Default select example" id="dropdown">
                    <option value="stock"selected>Stock</option>
                    <option value="surplus">Surplus Proyek</option>
                    <option value="dead">Dead Stock</option>
                    <option value="rongsokan">Rongsokan</option>
                    <option value="charges">Direct Charges</option>
                </select>
                <label for="dropdown">Kategori Material</label>
            </div>
            
            <div class="form-floating mb-3">
                <select name="kategoriPart" class="form-select form-control" aria-label="Default select example" id="dropdown">
                    <option value="#"selected>Klik Untuk Memilih</option>
                    @if (auth()->user()->role =='admin')
                        <option value="electrical">Electrical</option>
                        <option value="instrument">Instrument</option>
                        <option value="mechanical">Mechanical</option>
                        <option value="provision">Provision Tie In</option>
                        <option value="emergency">Emergency</option>
                        <option value="reliability">Reliability</option>
                        <option value="scrap">Scrap R & Q</option>
                        <option value="technology">Titipan IT</option>
                        <option value="tiyum">Titipan Layanan Umum</option>
                        <option value="scrayum">Scrap Layanan Umum</option>
                        <option value="sekper">Titipan Sekretaris Perusahaan</option>
                        <option value="hsse">Titipan HSSE</option>
                        <option value="gasorf">Titipan Distribusi Gas dan Manajemen Orf</option>
                        <option value="transportasi">Transportasi LNG & Operasional FSRU</option>
                        <option value="bisnis">Perencanaan & Pengembangan Bisnis</option>
                    @endif
                    @if (auth()->user()->role =='user' && auth()->user()->departement =='reliability')
                        <option value="electrical">Electrical</option>
                        <option value="instrument">Instrument</option>
                        <option value="mechanical">Mechanical</option>
                        <option value="provision">Provision Tie In</option>
                        <option value="emergency">Emergency</option>
                        <option value="reliability">Reliability</option>
                        <option value="scrap">Scrap R & Q</option>
                    @endif
                    @if (auth()->user()->role =='user' && auth()->user()->departement =='technology')    
                        <option value="technology">Titipan IT</option>
                    @endif
                    @if (auth()->user()->role =='user' && auth()->user()->departement =='layum')
                        <option value="tiyum">Titipan Layanan Umum</option>
                        <option value="scrayum">Scrap Layanan Umum</option>
                    @endif
                    @if (auth()->user()->role =='user' && auth()->user()->departement =='sekper')
                        <option value="sekper">Titipan Sekretaris Perusahaan</option>
                    @endif
                    @if (auth()->user()->role =='user' && auth()->user()->departement =='hsse')
                        <option value="hsse">Titipan HSSE</option>
                    @endif
                    @if (auth()->user()->role =='user' && auth()->user()->departement =='migas')
                        <option value="gasorf">Titipan Distribusi Gas dan Manajemen Orf</option>
                    @endif
                    @if (auth()->user()->role =='user' && auth()->user()->departement =='transportasi')
                        <option value="transportasi">Transportasi LNG & Operasional FSRU</option>
                    @endif
                    @if (auth()->user()->role =='user' && auth()->user()->departement =='bisnis')
                        <option value="bisnis">Perencanaan & Pengembangan Bisnis</option>
                    @endif
                </select>
                <label for="dropdown">Jenis</label>
            </div>

            <label>Deskripsi Spesifikasi</label>
            <div class="mb-3 mt-2">
                <textarea class="form-control" placeholder="Masukkan informasi-informasi penting, seperti manufaktur, merek, dan dimensi" style="height: 100px" 
                name="descPart" required></textarea>
            </div>
            
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
                <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com"  name="size" type="text">
                <label for="floatingInput">Size</label>
            </div>

            <div class="form-floating mb-3">
                <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px" 
                name="keterangan"></textarea>
                <label for="floatingTextarea2">Keterangan</label>
            </div>

            <div class="form-floating mb-3">
                <select name="lokasiPart" class="form-select form-control" aria-label="Default select example" id="dropdown">
                    <option value="Gudang Sunter"selected>Gudang Sunter</option>
                    <option value="Gudang Orf">Gudang ORF</option>
                </select>
                <label for="dropdown">Lokasi</label>
            </div>

            <div class="mb-3">
                <button class="btn greenAdd mt-3" type="submit">Simpan</button>
            </div>

    </form>

</div>



@endsection
