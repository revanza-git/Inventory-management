@extends('layouts.sidebar')

@section('content')

{{-- <style>
    div.dataTables_wrapper {
        width: 1000px;
        margin: 0 ;
    }
</style> --}}

<h1>Part Perencanaan & Pengembangan Bisnis</h1>

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
            @forelse ($bisnisList as $data)
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
                    @if (auth()->user()->role =='user' && auth()->user()->departement =='bisnis')
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
                    
                    @if(auth()->user()->role =='admin')
                        <form action="deletePart/{{$data->idPart}}" method="post">
                            @csrf
                            <div class="mt-2">
                                <button onclick="if (confirm('Yakin Mau Delete Data ? Tindakan ini tidak dapat dikembalikan')){return true;}else{event.stopPropagation(); event.preventDefault();};" class="btn btn-sm redDelete margin-button" type="submit"> <i class="bi bi-trash3-fill"></i> Delete
                                </button>
                            </div>
                        </form>
                    @endif
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