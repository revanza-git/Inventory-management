@extends('layouts.sidebar')

@section('content')
<h1>Request In Pending Part</h1>
{{-- {{dd($listPendingIn);}} --}}

@if(Session::has('status'))
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
                <th scope="col">No Part</th>
                <th scope="col">Quantity In</th>
                <th scope="col">Satuan</th>
                <th scope="col">Tanggal Masuk</th>
                <th scope="col">Cek Dokumen</th>
                <th scope="col">Cek Fisik</th>
                <th scope="col">Detail</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($listPendingIn as $data)
            <tr>
                <td scope="row">{{$loop->iteration}}</td>
                <td>{{$data->namaPart}}</td>
                <td>{{$data->noPart}}</td>
                <td>{{$data->qtyStockPartIn}}</td>
                <td>{{$data->satuanPart}}</td>
                <td>{{Carbon\Carbon::parse($data->dtStockPartIn)->isoFormat('LL');}}</td>
                @if ($data->firstApprovalPartIn =='Waiting For Approval')
                    <td class="bg-warning text-light">{{$data->firstApprovalPartIn}}</td>
                @elseif ($data->firstApprovalPartIn =='Revision')
                    <td class="bg-info text-light">{{$data->firstApprovalPartIn}}</td>
                @elseif ($data->firstApprovalPartIn =='Updated By User')
                    <td class="bg-primary text-light">{{$data->firstApprovalPartIn}}</td>
                @elseif ($data->firstApprovalPartIn =='Reject')
                    <td class="bg-danger text-light">{{$data->firstApprovalPartIn}}</td>
                @else
                    <td class="bg-success">{{$data->firstApprovalPartIn}}</td>
                @endif

                @if ($data->secondApprovalPartIn =='Waiting For Approval')
                    <td class="bg-warning text-light">{{$data->secondApprovalPartIn}}</td>
                @elseif ($data->secondApprovalPartIn =='Revision')
                    <td class="bg-info text-light">{{$data->secondApprovalPartIn}}</td>
                @elseif ($data->secondApprovalPartIn =='Updated By User')
                    <td class="bg-primary text-light">{{$data->secondApprovalPartIn}}</td>
                @elseif ($data->secondApprovalPartIn =='Reject')
                    <td class="bg-danger text-light">{{$data->secondApprovalPartIn}}</td>
                @else
                    <td class="bg-success">{{$data->secondApprovalPartIn}}</td>
                @endif
                <td>
                    
                    <a href='flowInPending-detail/{{$data->id_flowInPart}}'type="button" class="btn btn-sm blueDetail margin-button"
                        >
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-info-circle" viewBox="0 0 16 16">
                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                        <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
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


@endsection
