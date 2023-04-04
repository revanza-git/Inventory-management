@extends('layouts.sidebar')
@section('content')
<div class="mt-4">
    <div class="row">
        <div class="col-sm-6">
            <div class="card col-12 p-4"  >
                <h3 class="card-title">Laporan Triwulan</h3>
                <p>Filter Berdasarkan : </p>
                <div class="card-body" >
                    {{-- ACCORDIONS --}}
                    <div id="main">
                        <div class="container">
                        <div class="accordion" id="faq">
                                            <div class="card">
                                                <div class="card-header" id="faqhead1">
                                                    <a href="#" class="btn btn-header-link" data-toggle="collapse" data-target="#faq1"
                                                    aria-expanded="true" aria-controls="faq1">Jenis</a>
                                                </div>

                                                <div id="faq1" class="collapse show" aria-labelledby="faqhead1" data-parent="#faq">
                                                    <div class="card-body">
                                                        <div class="mt-3 col-11">
                                                            <form action="/showReport" method="POST">
                                                                @csrf
                                                                <div class="mb-3">
                                                                    <label>Pilih Jenis:</label>
                                                                    <select name="kategoriPart" class="form-select form-control" aria-label="Default select example" >
                                                                        <option value="electrical" selected>Electrical</option>
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
                                                                        <option value="hsse">HSSE</option>
                                                                        <option value="gasorf">Distribusi Gas dan Orf</option>
                                                                    </select>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label>Pilih Triwulan :</label>
                                                                    <select name="triwulan" class="form-select form-control" aria-label="Default select example" >
                                                                        <option value="1" selected>Triwulan I (Januari - Maret)</option>
                                                                        <option value="2">Triwulan II (April - Juni)</option>
                                                                        <option value="3">Triwulan III (Juli - September)</option>
                                                                        <option value="4">Triwulan IV (Oktober - Desember)</option>
                                                                    </select>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label>Pilih Tahun :</label>
                                                                    <select name="year" class="form-select form-control" aria-label="Default select example" >
                                                                        @foreach ($year as $y)
                                                                            <option value="{{$y}}">{{$y}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="mt-5">
                                                                    <button class="btn btn-sm greenAdd" type="submit">Lihat Laporan</button>
                                                                </div>

                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card">
                                                <div class="card-header" id="faqhead2">
                                                    <a href="#" class="btn btn-header-link collapsed" data-toggle="collapse" data-target="#faq2"
                                                    aria-expanded="true" aria-controls="faq2">Kategori</a>
                                                </div>

                                                <div id="faq2" class="collapse" aria-labelledby="faqhead2" data-parent="#faq">
                                                    <div class="card-body">
                                                        <div class="mt-3 col-11">
                                                            <form action="/showReportKategoriMaterial" method="POST">
                                                                @csrf
                                                                <div class="mb-3">
                                                                    <label>Pilih Jenis:</label>
                                                                    <select name="kategoriPart" class="form-select form-control" aria-label="Default select example" >
                                                                        <option value="electrical" selected>Electrical</option>
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
                                                                    </select>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label>Pilih Triwulan :</label>
                                                                    <select name="triwulan" class="form-select form-control" aria-label="Default select example" >
                                                                        <option value="1" selected>Triwulan I (Januari - Maret)</option>
                                                                        <option value="2">Triwulan II (April - Juni)</option>
                                                                        <option value="3">Triwulan III (Juli - September)</option>
                                                                        <option value="4">Triwulan IV (Oktober - Desember)</option>
                                                                    </select>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label>Kategori Material</label>
                                                                    <select name="kategoriMaterial" class="form-select form-control" aria-label="Default select example" >
                                                                        <option value="stock"selected>Stock</option>
                                                                        <option value="surplus">Surplus Proyek</option>
                                                                        <option value="dead">Dead Stock</option>
                                                                        <option value="rongsokan">Rongsokan</option>
                                                                        <option value="charges">Direct Charges</option>
                                                                    </select>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label>Pilih Tahun :</label>
                                                                    <select name="year" class="form-select form-control" aria-label="Default select example" >
                                                                        @foreach ($year as $y)
                                                                            <option value="{{$y}}">{{$y}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="mt-5">
                                                                    <button class="btn btn-sm greenAdd" type="submit">Lihat Laporan</button>
                                                                </div>

                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card">
                                                <div class="card-header" id="faqhead3">
                                                    <a href="#" class="btn btn-header-link collapsed" data-toggle="collapse" data-target="#faq3"
                                                    aria-expanded="true" aria-controls="faq3">Lokasi</a>
                                                </div>

                                                <div id="faq3" class="collapse" aria-labelledby="faqhead3" data-parent="#faq">
                                                    <div class="card-body">
                                                        <div class="mt-3 col-11">
                                                            <form action="/showReportLokasi" method="POST">
                                                                @csrf
                                                                <div class="mb-3">
                                                                    <label>Pilih Jenis:</label>
                                                                    <select name="kategoriPart" class="form-select form-control" aria-label="Default select example" >
                                                                        <option value="electrical" selected>Electrical</option>
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
                                                                    </select>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label>Pilih Triwulan :</label>
                                                                    <select name="triwulan" class="form-select form-control" aria-label="Default select example" >
                                                                        <option value="1" selected>Triwulan I (Januari - Maret)</option>
                                                                        <option value="2">Triwulan II (April - Juni)</option>
                                                                        <option value="3">Triwulan III (Juli - September)</option>
                                                                        <option value="4">Triwulan IV (Oktober - Desember)</option>
                                                                    </select>
                                                                </div>
                                                                <label >Lokasi</label>
                                                                <div class="mb-3">
                                                                    <select name="lokasiPart" class="form-select form-control" aria-label="Default select example" >
                                                                        <option value="Gudang Sunter"selected>Gudang Sunter</option>
                                                                        <option value="Gudang Orf">Gudang ORF</option>
                                                                    </select>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label>Pilih Tahun :</label>
                                                                    <select name="year" class="form-select form-control" aria-label="Default select example" >
                                                                        @foreach ($year as $y)
                                                                            <option value="{{$y}}">{{$y}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="mt-5">
                                                                    <button class="btn btn-sm greenAdd" type="submit">Lihat Laporan</button>
                                                                </div>

                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card">
                                                <div class="card-header" id="faqhead4">
                                                    <a href="#" class="btn btn-header-link collapsed" data-toggle="collapse" data-target="#faq4"
                                                    aria-expanded="true" aria-controls="faq4">Semua</a>
                                                </div>

                                                <div id="faq4" class="collapse" aria-labelledby="faqhead4" data-parent="#faq">
                                                    <div class="card-body">
                                                        <div class="mt-3 col-11">
                                                            <form action="/showReportAll" method="POST">
                                                                @csrf
                                                                <div class="mb-3">
                                                                    <label>Pilih Jenis:</label>
                                                                    <select name="kategoriPart" class="form-select form-control" aria-label="Default select example" >
                                                                        <option value="electrical" selected>Electrical</option>
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
                                                                    </select>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label>Pilih Triwulan :</label>
                                                                    <select name="triwulan" class="form-select form-control" aria-label="Default select example" >
                                                                        <option value="1" selected>Triwulan I (Januari - Maret)</option>
                                                                        <option value="2">Triwulan II (April - Juni)</option>
                                                                        <option value="3">Triwulan III (Juli - September)</option>
                                                                        <option value="4">Triwulan IV (Oktober - Desember)</option>
                                                                    </select>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label>Kategori Material</label>
                                                                    <select name="kategoriMaterial" class="form-select form-control" aria-label="Default select example" >
                                                                        <option value="stock"selected>Stock</option>
                                                                        <option value="surplus">Surplus Proyek</option>
                                                                        <option value="dead">Dead Stock</option>
                                                                        <option value="rongsokan">Rongsokan</option>
                                                                        <option value="charges">Direct Charges</option>
                                                                    </select>
                                                                </div>
                                                                <div class="mb-3">
                                                                <label >Lokasi</label>
                                                                <div class="mb-3">
                                                                    <select name="lokasiPart" class="form-select form-control" aria-label="Default select example" >
                                                                        <option value="Gudang Sunter"selected>Gudang Sunter</option>
                                                                        <option value="Gudang Orf">Gudang ORF</option>
                                                                    </select>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label>Pilih Tahun :</label>
                                                                    <select name="year" class="form-select form-control" aria-label="Default select example" >
                                                                        @foreach ($year as $y)
                                                                            <option value="{{$y}}">{{$y}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="mt-5">
                                                                    <button class="btn btn-sm greenAdd" type="submit">Lihat Laporan</button>
                                                                </div>

                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
        

        
        {{-- CARD 2 --}}
        <div class="col-sm-6">
            <div class="card col-12 p-4"  >
                <h3 class="card-title">Laporan Triwulan Custom</h3>
                <p>Filter Berdasarkan : </p>
                <div class="card-body" >
                    {{-- ACCORDIONS --}}
                    <div id="main">
                        <div class="container">
                        <div class="accordion" id="faq">
                                            <div class="card">
                                                <div class="card-header" id="faqhead5">
                                                    <a href="#" class="btn btn-header-link" data-toggle="collapse" data-target="#faq5"
                                                    aria-expanded="true" aria-controls="faq5">Jenis</a>
                                                </div>

                                                <div id="faq5" class="collapse show" aria-labelledby="faqhead5" data-parent="#faq">
                                                    <div class="card-body">
                                                        <div class="mt-3 col-11">
                                                        <form action="/showCustomReport" method="POST">
                                                            @csrf
                                                            <div class="mb-3">
                                                                <label>Pilih Jenis:</label>
                                                                <select name="kategoriPart" class="form-select form-control" aria-label="Default select example" required>
                                                                    <option value="electrical" selected>Electrical</option>
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
                                                                </select>
                                                            </div>
                                                            <div class="form-floating mb-3">
                                                                <input type="date" class="form-control" id="floatingInput" name="dtFirstRange" required>
                                                                <label for="floatingInput">Date From :</label>
                                                            </div>
                                                            <div class="form-floating mb-3">
                                                                    <input type="date" class="form-control" id="floatingInput" name="dtSecondRange" required >
                                                                    <label for="floatingInput">Date To :</label>
                                                            </div> 

                                                            <div class="mt-5">
                                                                <button class="btn btn-sm greenAdd" type="submit">Lihat Laporan</button>
                                                            </div>

                                                        </form>
                                                    </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card">
                                                <div class="card-header" id="faqhead6">
                                                    <a href="#" class="btn btn-header-link collapsed" data-toggle="collapse" data-target="#faq6"
                                                    aria-expanded="true" aria-controls="faq6">Kategori</a>
                                                </div>

                                                <div id="faq6" class="collapse" aria-labelledby="faqhead6" data-parent="#faq">
                                                    <div class="card-body">
                                                        <div class="mt-3 col-11">
                                                            <form action="/showCustomReportKategoriMaterial" method="POST">
                                                                @csrf
                                                                <div class="mb-3">
                                                                    <label>Pilih Jenis:</label>
                                                                    <select name="kategoriPart" class="form-select form-control" aria-label="Default select example" >
                                                                        <option value="electrical" selected>Electrical</option>
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
                                                                    </select>
                                                                </div>
                                                                <div class="form-floating mb-3">
                                                                    <input type="date" class="form-control" id="floatingInput" name="dtFirstRange" required>
                                                                    <label for="floatingInput">Date From :</label>
                                                                </div>
                                                                <div class="form-floating mb-3">
                                                                    <input type="date" class="form-control" id="floatingInput" name="dtSecondRange" required >
                                                                    <label for="floatingInput">Date To :</label>
                                                                </div> 
                                                                <div class="mb-3">
                                                                    <label>Kategori Material</label>
                                                                    <select name="kategoriMaterial" class="form-select form-control" aria-label="Default select example" >
                                                                        <option value="stock"selected>Stock</option>
                                                                        <option value="surplus">Surplus Proyek</option>
                                                                        <option value="dead">Dead Stock</option>
                                                                        <option value="rongsokan">Rongsokan</option>
                                                                        <option value="charges">Direct Charges</option>
                                                                    </select>
                                                                </div>
                                                                <div class="mt-5">
                                                                    <button class="btn btn-sm greenAdd" type="submit">Lihat Laporan</button>
                                                                </div>

                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card">
                                                <div class="card-header" id="faqhead7">
                                                    <a href="#" class="btn btn-header-link collapsed" data-toggle="collapse" data-target="#faq7"
                                                    aria-expanded="true" aria-controls="faq7">Lokasi</a>
                                                </div>

                                                <div id="faq7" class="collapse" aria-labelledby="faqhead7" data-parent="#faq">
                                                    <div class="card-body">
                                                        <div class="mt-3 col-11">
                                                            <form action="/showCustomReportLokasi" method="POST">
                                                                @csrf
                                                                <div class="mb-3">
                                                                    <label>Pilih Jenis:</label>
                                                                    <select name="kategoriPart" class="form-select form-control" aria-label="Default select example" >
                                                                        <option value="electrical" selected>Electrical</option>
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
                                                                    </select>
                                                                </div>
                                                                <div class="form-floating mb-3">
                                                                    <input type="date" class="form-control" id="floatingInput" name="dtFirstRange" required>
                                                                    <label for="floatingInput">Date From :</label>
                                                                </div>
                                                                <div class="form-floating mb-3">
                                                                    <input type="date" class="form-control" id="floatingInput" name="dtSecondRange" required >
                                                                    <label for="floatingInput">Date To :</label>
                                                                </div> 
                                                                <label >Lokasi</label>
                                                                <div class="mb-3">
                                                                    <select name="lokasiPart" class="form-select form-control" aria-label="Default select example" >
                                                                        <option value="Gudang Sunter"selected>Gudang Sunter</option>
                                                                        <option value="Gudang Orf">Gudang ORF</option>
                                                                    </select>
                                                                </div>
                                                                <div class="mt-5">
                                                                    <button class="btn btn-sm greenAdd" type="submit">Lihat Laporan</button>
                                                                </div>

                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card">
                                                <div class="card-header" id="faqhead8">
                                                    <a href="#" class="btn btn-header-link collapsed" data-toggle="collapse" data-target="#faq8"
                                                    aria-expanded="true" aria-controls="faq8">Semua</a>
                                                </div>

                                                <div id="faq8" class="collapse" aria-labelledby="faqhead8" data-parent="#faq">
                                                    <div class="card-body">
                                                        <div class="mt-3 col-11">
                                                            <form action="/showCustomReportAll" method="POST">
                                                                @csrf
                                                                <div class="mb-3">
                                                                    <label>Pilih Jenis:</label>
                                                                    <select name="kategoriPart" class="form-select form-control" aria-label="Default select example" >
                                                                        <option value="electrical" selected>Electrical</option>
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
                                                                    </select>
                                                                </div>
                                                                 <div class="form-floating mb-3">
                                                                    <input type="date" class="form-control" id="floatingInput" name="dtFirstRange" required>
                                                                    <label for="floatingInput">Date From :</label>
                                                                </div>
                                                                <div class="form-floating mb-3">
                                                                    <input type="date" class="form-control" id="floatingInput" name="dtSecondRange" required >
                                                                    <label for="floatingInput">Date To :</label>
                                                                </div> 
                                                                <div class="mb-3">
                                                                    <label>Kategori Material</label>
                                                                    <select name="kategoriMaterial" class="form-select form-control" aria-label="Default select example" >
                                                                        <option value="stock"selected>Stock</option>
                                                                        <option value="surplus">Surplus Proyek</option>
                                                                        <option value="dead">Dead Stock</option>
                                                                        <option value="rongsokan">Rongsokan</option>
                                                                        <option value="charges">Direct Charges</option>
                                                                    </select>
                                                                </div>
                                                                <div class="mb-3">
                                                                <label >Lokasi</label>
                                                                <div class="mb-3">
                                                                    <select name="lokasiPart" class="form-select form-control" aria-label="Default select example" >
                                                                        <option value="Gudang Sunter"selected>Gudang Sunter</option>
                                                                        <option value="Gudang Orf">Gudang ORF</option>
                                                                    </select>
                                                                </div>
                                                                <div class="mt-5">
                                                                    <button class="btn btn-sm greenAdd" type="submit">Lihat Laporan</button>
                                                                </div>

                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>   
        
        
        
    
</div>
@endsection