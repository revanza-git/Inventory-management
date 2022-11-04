@extends('layouts.sidebar')

@section('content')

<h1>Part Instrument</h1>

{{-- Logic bila berhasil crud untuk session flash --}}
@if(Session::has('status')||Session::has('statusPlusStockElect')
    ||Session::has('statusMinusStockElect')||Session::has('statusUpdateElectrical'))
    <div class="alert greenAdd" role="alert" id="box">
        <div>{{Session::get('message')}}</div>
    </div>

@endif


<div class="table-responsive-sm mt-4">
    <table id="myTable" class="table table-bordered table-hover mt-2 table-striped">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Nama Part</th>
                <th scope="col">Spesifikasi</th>
                <th scope="col">Size</th>
                <th scope="col">Lokasi</th>
                <th scope="col">Kategori</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($instrumentList as $data)
            <tr>
                <td scope="row">{{$loop->iteration}}</td>
                <td>{{ucwords($data->namaPart)}}</td>
                <td>{{$data->descPart}}</td>

                @empty($data->size)
                    <td>-</td>
                @else 
                    <td>{{$data->size}}</td>
                @endempty

                <td>{{$data->lokasiPart}}</td>
                
                @if($data->kategoriMaterial=='stock')
                <td>Material Persediaan ({{ucwords($data->kategoriMaterial)}})</td>
                @elseif($data->kategoriMaterial=='surplus')
                <td>Material Projek ({{ucwords($data->kategoriMaterial)}})</td>
                @elseif($data->kategoriMaterial=='rongsokan')
                <td>Material ({{ucwords($data->kategoriMaterial)}})</td>
                @elseif($data->kategoriMaterial=='dead')
                <td>Material Persediaan Mati ({{ucwords($data->kategoriMaterial)}})</td>
                @elseif($data->kategoriMaterial=='charges')
                <td>Material Bukan Persediaan (Direct {{ucwords($data->kategoriMaterial)}})</td>
                @endif
                
                <td>
                    @if(auth()->user()->role =='admin')
                        <a type="button" class="btn btn-sm greenAcc customMarginButton" 
                        href="/plusOldStock/{{$data->idPart}}">
                            <i class="bi bi-plus-circle"></i> Stok Lama
                        </a>
                        <a type="button" class="btn btn-sm redRej customMarginButton" 
                        href="/minusOldStock/{{$data->idPart}}">
                           <i class="bi bi-dash-circle"></i> Stok Lama
                        </a>
                        <a type="button" class="btn btn-sm orangeEdit customMarginButton" 
                        href="{{$data->kategoriPart}}-edit/{{$data->idPart}}">
                            <i class="bi bi-arrow-clockwise"></i> Edit
                        </a>
                    @endif
                    @if (auth()->user()->role =='user' && auth()->user()->departement =='reliability')
                        <a type="button" class="btn btn-sm greenAcc customMarginButton" 
                        href="{{$data->kategoriPart}}-plus-stock/{{$data->idPart}}">
                            <i class="bi bi-plus-circle"></i> Stok
                        </a>
                        <a type="button" class="btn btn-sm redRej customMarginButton" 
                        href="{{$data->kategoriPart}}-minus-stock/{{$data->idPart}}">
                           <i class="bi bi-dash-circle"></i> Stok
                        </a>
                        <a type="button" class="btn btn-sm orangeEdit customMarginButton" 
                        href="{{$data->kategoriPart}}-edit/{{$data->idPart}}">
                           <i class="bi bi-arrow-clockwise"></i> Edit
                        </a>
                    @endif 
                    <a href='{{$data->kategoriPart}}-detail/{{$data->idPart}}'type="button" class="btn btn-sm blueDetail customMarginButton">
                        <i class="bi bi-info-circle"></i> Detail
                    </a>
                    
                </td>
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