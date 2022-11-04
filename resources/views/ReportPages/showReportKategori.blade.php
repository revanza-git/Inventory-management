@extends('layouts.sidebar')
@section('content')
<style>
    div.dataTables_wrapper {
        width: 1200px;
        margin: 0 ;
    }
</style>

{{-- KONDISI JUDUL AJAAA --}}
@if($material == 'stock')
    <h2>Laporan Material Persediaan ({{ucwords($material)}}) {{ucwords($kategori)}} Triwulan {{$triwulan}} ({{$year}})</h2>
@elseif($material == 'surplus')
    <h2>Laporan Material Projek / ({{ucwords($material)}}) Projek {{ucwords($kategori)}} Triwulan {{$triwulan}} ({{$year}})</h2>
@elseif($material == 'dead')
    <h3>Laporan Material Persediaan Mati / ({{ucwords($material)}}) Stock Projek {{ucwords($kategori)}} Triwulan {{$triwulan}} ({{$year}})</h3>
@elseif($material == 'rongsokan')
    <h3>Laporan Material {{ucwords($material)}} {{ucwords($kategori)}} Triwulan {{$triwulan}} ({{$year}})</h3>
@else
    <h3>Laporan Material Bukan Persediaan( Direct {{ucwords($material)}} ) {{ucwords($kategori)}} Triwulan {{$triwulan}} ({{$year}})</h3>
@endif

{{-- <h2>Laporan {{ucwords($material)}} {{ucwords($kategori)}} Triwulan {{$triwulan}} ({{$year}})</h2> --}}

<form action="/exportCategory-report" method="post">
    @csrf
    <input type="hidden" name="triwulan" value="{{$triwulan}}">
    <input type="hidden" name="year" value="{{$year}}">
    <input type="hidden" name="kategori" value="{{$kategori}}">
    <input type="hidden" name="firstRange" value="{{$firstRange}}">
    <input type="hidden" name="secondRange" value="{{$secondRange}}">
    <input type="hidden" name="kategoriMaterial" value="{{$material}}">
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
                <th scope="col">Lokasi</th>
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
                <td>{{$data->lokasiPart}}</td>
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