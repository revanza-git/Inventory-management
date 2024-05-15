@extends('layouts.sidebar')
@section('content')
<style>
    div.dataTables_wrapper {
        width: 1200px;
        margin: 0 ;
    }
</style>

<?php
    function cat($cat) {
        if($cat=='provision') {
            return "Provision Tie In";
        }
        else if($cat=='scrap') {
            return "Scrap R & Q";
        }
        else if($cat=='technology') {
            return "Titipan IT";
        }
        else if($cat=='tiyum') {
            return "Titipan Layanan Umum";
        }
        else if($cat=='scrayum') {
            return "Scrap Layanan Umum";
        }
        else if($cat=='sekper') {
            return "Titipan Sekretaris Perusahaan";
        }
        else if($cat=='hsse') {
            return "HSSE";
        }
        else if($cat=='gasorf') {
            return "Titipan Distribusi Gas dan ORF";
        }
        else if($cat=='transportasi') {
            return "Transportasi LNG & Operasional FSRU";
        }
        else if($cat=='bisnis') {
            return "Perencanaan & Pengembangan Bisnis";
        }
        else {
            return ucwords($cat);
        }
    }
?>

{{-- 
<h2>Laporan {{ucwords($material)}} {{cat($kategori)}} Triwulan {{$triwulan}} {{ucwords($lokasiPart)}} ({{$year}})</h2> --}}

@if($material == 'stock')
    <h2>Laporan Material Persediaan ({{ucwords($material)}}) {{cat($kategori)}} Triwulan {{$triwulan}} {{ucwords($lokasiPart)}} ({{$year}})</h2>
@elseif($material == 'surplus')
    <h2>Laporan Material Projek / ({{ucwords($material)}}) Projek {{cat($kategori)}} Triwulan {{$triwulan}} {{ucwords($lokasiPart)}} ({{$year}})</h2>
@elseif($material == 'dead')
    <h3>Laporan Material Persediaan Mati / ({{ucwords($material)}}) Stock Projek {{cat($kategori)}} Triwulan {{$triwulan}} {{ucwords($lokasiPart)}} ({{$year}})</h3>
@elseif($material == 'rongsokan')
    <h3>Laporan Material {{ucwords($material)}} {{cat($kategori)}} Triwulan {{$triwulan}} {{ucwords($lokasiPart)}} ({{$year}})</h3>
@else
    <h3>Laporan Material Bukan Persediaan( Direct {{ucwords($material)}} ) {{cat($kategori)}} Triwulan {{$triwulan}} {{ucwords($lokasiPart)}} ({{$year}})</h3>
@endif

<form action="/inventory/exportAll-report" method="post">
    @csrf
    <input type="hidden" name="triwulan" value="{{$triwulan}}">
    <input type="hidden" name="year" value="{{$year}}">
    <input type="hidden" name="kategori" value="{{$kategori}}">
    <input type="hidden" name="firstRange" value="{{$firstRange}}">
    <input type="hidden" name="secondRange" value="{{$secondRange}}">
    <input type="hidden" name="kategoriMaterial" value="{{$material}}">
    <input type="hidden" name="lokasiPart" value="{{$lokasiPart}}">
    <div class="mt-3">
        <button class="btn greenAdd btn-md" type="submit">
        <i class="bi bi-download"></i> Excel
        </button>
    </div>
</form>



<div class="table-responsive-sm mt-4">
    <table id="reportKategoriTable" class="table table-bordered table-hover mt-2 table-striped">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Nama Part</th>
                <th scope="col">Deskripsi</th>
                <th scope="col">Size</th>
                <th scope="col">Satuan</th>
                <th scope="col">Jumlah Awal</th>
                <th scope="col">Jumlah Akhir</th>
                <th scope="col">Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($list as $data)
            <tr>
                <td scope="row">{{$loop->iteration}}</td>
                <td>{{$data->namaPart}}</td>
                <td>{{$data->descPart}}</td>
                 <td>{{$data->size}}</td>
                <td>{{$data->satuanPart}}</td>
                <td>{{$data->stockAwal}}</td>
                <td>{{$data->stockAkhir}}</td>
                <td>{{$data->keterangan}}</td>
            </tr>
            @empty
            <td colspan="8" class="text-center">
                Tidak ada Data
            </td>
            @endforelse
        </tbody>
    </table>
</div>
@endsection