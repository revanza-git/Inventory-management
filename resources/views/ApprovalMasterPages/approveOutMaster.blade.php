@extends('layouts.sidebar') 
@section('content') @if (session()->has('success'))
<div class="alert greenAdd" role="alert" id="box">
    <div>{{session('success')}}</div>
</div>
@endif
{{-- {{dd($list);}} --}}
<h1>Formulir Terima Barang</h1>

<div class="card col-8 mt-3 cardHeadCustom">
    <div class="card-body">
        <h4 class="card-title">Detail Request</h4>
        <ol>
            <li>
                <h6 class="card-subtitle mt-2 text-white">Nama Requester :
                    {{$name}}</h6>
            </li>
            <li>
                <h6 class="card-subtitle mt-2 text-white">Dept.Requester : Dept.{{$department}}</h6>
            </li>
            <li>
                <h6 class="card-subtitle mt-2 text-white">Tanggal Pengajuan :
                    {{Carbon\Carbon::parse($date)->isoFormat('LL');}}</h6>
            </li>
        </ol>

    </div>
</div>

{{-- TODO:TABEL 1 --}}
<div class="table-responsive-sm mt-4">
    <table
        id="tableFormCustom"
        class="table table-bordered table-hover mt-2 table-striped">
        <thead>
            <tr>
                <th
                    scope="col"
                    colspan="9"
                    class="text-center"
                    style="background-color: #293462;color:white">Detail Form</th>
            </tr>
            <tr>
                <th scope="col">No</th>
                <th scope="col">No Part</th>
                <th scope="col">Nama Barang</th>
                <th scope="col">Jumlah</th>
                <th scope="col">Satuan</th>
                <th scope="col">Harga</th>
                <th scope="col">Keperluan</th>
                
                <th scope="col">Detail</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($list as $data)
            <tr>
                <td scope="row">{{$loop->iteration}}</td>
                <td>{{$data->noPart}}</td>
                <td>{{$data->namaPart}}</td>
                <td>{{$data->qtyStockPartOut}}</td>
                <td>{{$data->satuanPart}}</td>
                <td>{{$data->priceStockPartOut}}</td>
                <td>{{$data->needsStockPartOut}}</td>
                <td>
                    <a
                        href='/flowInPending-detail/{{$data->id_flowOutPart}}'
                        type="button"
                        class="btn btn-sm blueDetail margin-button">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            width="16"
                            height="16"
                            fill="currentColor"
                            class="bi bi-info-circle"
                            viewbox="0 0 16 16">
                            <path
                                d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                            <path
                                d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
                        </svg>
                        Detail
                    </button>
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

@php $arrayOfId = array(); foreach ($list as $data) {
array_push($arrayOfId,$data->id_flowOutPart); 
} // json_encode($arrayOfId);
@endphp
<div class="mt-3 mb-3  justify-content-center">

    <form action="/inventory/approveAllOutMaster" method="post">
        @csrf 
        @foreach($arrayOfId as $id)
        <input type="hidden" name="arrayOfId[]" value="{{$id}}">
        @endforeach
        <div class="mb-3">
            <button
                onclick="if (confirm('Yakin Approve Request ini?')){return true;}else{event.stopPropagation(); event.preventDefault();};"
                class="btn btn-sm greenAdd margin-button col-12"
                type="submit">Approve</button>
        </div>
    </form>

    <form action="/inventory/revisionAllOutMaster" method="post">
        @csrf 
        @foreach($arrayOfId as $id)
        <input type="hidden" name="arrayOfId[]" value="{{$id}}">
        @endforeach
        <div class="mb-3 mt-3">
            <h6>Alasan Revisi:</h6>
            <div class="form-floating mb-3">
                <textarea class="form-control" placeholder="Leave a comment here"  style="height: 100px" 
                name="ReasonFourthApprovalPartOut"></textarea>
            </div>
            <button
                onclick="if (confirm('Yakin Merevisi Request ini?')){return true;}else{event.stopPropagation(); event.preventDefault();};"
                class="btn btn-sm orangeAdd margin-button col-12"
                type="submit">Revisi
            </button>
        </div>
    </form>
</div>

{{-- TODO:TABEL 2 --}}
<div class="table-responsive-sm mt-4">
    <table
        id="tableWithoutSearch"
        class="table table-bordered table-hover mt-2 table-striped">
        <thead>
            <tr>
                <th
                    scope="col"
                    colspan="9"
                    class="text-center"
                    style="background-color: #293462;color:white">Download</th>
            </tr>
            <tr>
                <th scope="col">Download Dokumen</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($list as $data)
            <tr>
                <td scope="row">
                    @if (empty($data->filePhotoPartOut) && empty($data->filePO) &&
                    empty($data->fileBAST))
                    <p>Data Dokumen Tidak ada</p>
                    @endif @if (!empty($data->filePhotoPartOut))
                    <a
                        type="button"
                        class="btn btn-sm greenAcc margin-button"
                        href="{{ asset('data/'.$data->filePhotoPartOut) }}">Foto
                        {{$data->namaPart}}</a>
                    @endif @if (!empty($data->filePO))
                    <a
                        type="button"
                        class="btn btn-sm greenAcc margin-button"
                        href="{{ asset('data/'.$data->filePO) }}"
                        target="_blank">PO
                        {{$data->namaPart}}</a>
                    @endif @if (!empty($data->fileBAST))
                    <a
                        type="button"
                        class="btn btn-sm greenAcc margin-button"
                        href="{{ asset('data/'.$data->fileBAST) }}"
                        target="_blank">BAST
                        {{$data->namaPart}}</a>
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