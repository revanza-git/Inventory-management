@extends('layouts.sidebar')
@section('content')
@if (session()->has('success'))
<div class="alert greenAdd" role="alert" id="box">
    <div>{{session('success')}}</div>
</div>
@endif
{{-- {{dd($list);}} --}}
<h1>Formulir Keluar Barang</h1>

<div class="card col-8 mt-3 cardHeadCustom">
            <div class="card-body">
                <h4 class="card-title">Detail Request</h4>
                <ol>
                    <li><h6 class="card-subtitle mt-2 text-white">Nama Requester : {{$name}}</h6></li>
                    <li><h6 class="card-subtitle mt-2 text-white">Dept.Requester : Dept.{{$department}}</h6></li>
                    <li><h6 class="card-subtitle mt-2 text-white">Tanggal Pengajuan : {{Carbon\Carbon::parse($date)->isoFormat('LL');}}</h6></li>
                </ol>
                
            </div>
</div>

{{-- TODO:TABEL 1 --}}
<div class="table-responsive-sm mt-4">
    <table id="tableFormCustom" class="table table-bordered table-hover mt-2 table-striped">
        <thead>
            <tr> 
                <th scope="col" colspan="9" class="text-center" style="background-color: #293462;color:white">Detail Form</th> 
            </tr>
            <tr>
                <th scope="col">No</th>
                <th scope="col">No Part</th>
                <th scope="col">Nama Barang</th>
                <th scope="col">Jumlah</th>
                <th scope="col">Size</th>
                <th scope="col">Satuan</th>
                <th scope="col">Harga</th>
                <th scope="col">Keperluan</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($list as $data)
            <tr>
                <td scope="row">{{$loop->iteration}}</td>
                <td>{{$data->noPart}}</td>
                <td>{{$data->namaPart}}</td>
                <td>{{$data->qtyStockPartOut}}</td>
                <td>{{$data->size}}</td>
                <td>{{$data->satuanPart}}</td>
                <td>{{$data->priceStockPartOut}}</td>
                <td>{{$data->needsStockPartOut}}</td>
                <td>
                   @if ($data->firstApprovalPartOut=='Approved' && $data->secondApprovalPartOut=='Approved')
                   
                   @else
                   <a type="button" class="btn btn-sm orangeEdit margin-button" 
                    href="/flowOut{{ucwords($data->kategoriPart)}}-edit/{{$data->id_flowOutPart}}">
                    Edit
                   </a>
                   @endif 
                   <a type="button" class="btn btn-sm blueDetail margin-button"
                    href="/flowOut{{ucwords($data->kategoriPart)}}-detail/{{$data->id_flowOutPart}}">
                    Detail
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


{{-- TODO:TABEL 2 --}}
<div class="table-responsive-sm mt-4">
    <table id="tableWithoutSearch" class="table table-bordered table-hover mt-2 table-striped">
        <thead>
            <tr> 
                <th scope="col" colspan="9" class="text-center" style="background-color: #293462;color:white">Download</th> 
            </tr>
            <tr>
                <th scope="col">Download Dokumen</th>  
            </tr>
        </thead>
        <tbody>
            @forelse ($list as $data)
            <tr>
                <td scope="row"> 
                        @if (empty($data->filePhotoPartOut) && empty($data->filePO) && empty($data->fileBAST))
                            <p>Data Dokumen Tidak ada</p>
                        @endif
                        @if (!empty($data->filePhotoPartOut))
                        <a type="button" class="btn btn-sm greenAcc margin-button" 
                        href="{{ asset('data/'.$data->filePhotoPartOut) }}">Foto {{$data->namaPart}}</a> 
                        @endif
                        @if (!empty($data->filePO))
                        <a type="button" class="btn btn-sm greenAcc margin-button" 
                        href="{{ asset('data/'.$data->filePO) }}" target="_blank"><i class="bi bi-file-earmark-pdf-fill"></i> {{$data->namaPart}}</a>
                        @endif
                        @if (!empty($data->fileBAST))
                        <a type="button" class="btn btn-sm greenAcc margin-button" 
                        href="{{ asset('data/'.$data->fileBAST) }}" target="_blank"><i class="bi bi-file-earmark-pdf-fill"></i> {{$data->namaPart}}</a>
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