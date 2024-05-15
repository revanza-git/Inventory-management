@extends('layouts.sidebar')
@section('content')

{{-- {{dd($list);}} --}}
<h1>Formulir Terima Barang</h1>

<div class="card col-8 mt-3 cardHeadCustom">
            <div class="card-body">
                <h4 class="card-title">Detail Request</h4>
                <ol>
                    <li><h6 class="card-subtitle mt-2 text-white">FTB: {{$noFtb}}</h6></li>
                    <li><h6 class="card-subtitle mt-2 text-white">Nama Requester : {{$name}}</h6></li>
                    <li><h6 class="card-subtitle mt-2 text-white">Dept.Requester : Dept.{{$department}}</h6></li>
                    <li><h6 class="card-subtitle mt-2 text-white">Tanggal Pengajuan : 
                        {{Carbon\Carbon::parse($list[0]->dtStockPartIn)->isoFormat('LL');}}</h6></li>
                </ol>
                
            </div>
</div>

    <div class="table-responsive-sm mt-2">
        <table id="tableWithoutSearch" class="table table-bordered table-hover mt-2 table-striped">
             <thead>  
                 <tr>
                 <th scope="col" colspan="5" class="text-center" style="background-color: #293462;color:white">Detail Approval</th>   
                 </tr>   
                 <tr>
                        <th scope="col">No</th>
                        <th scope="col">Tanggal</th>
                        <th scope="col">Status</th>
                        <th scope="col">Keterangan Status</th>
                        <th scope="col">Nama Penanggung Jawab</th>
                        
                 </tr>
             </thead>
             <tbody>
                <tr>
                    <td>1</td>
                    <td> {{Carbon\Carbon::parse($list[0]->dtStockPartIn)->format('d, M Y');}}</td>
                    @if (($list[0]->firstApprovalPartIn=='Approved') &&($list[0]->secondApprovalPartIn=='Approved')
                        &&($list[0]->thirdApprovalPartIn=='Approved') &&($list[0]->fourthApprovalPartIn=='Approved')) 
                        <td class="bg-success">Done</td>
                    @else
                        <td>Pending</td>
                    @endif
                    <td>Request</td>
                    <td>{{$name}}</td>
                    
                </tr>
                <tr>
                    <td>2</td>
                    <td>{{$list[0]->timeFirstApprovalPartIn}}</td>
                     @if ($list[0]->firstApprovalPartIn =='Waiting For Approval')
                                <td class="bg-warning text-light">{{$list[0]->firstApprovalPartIn}}</td>
                            @elseif ($list[0]->firstApprovalPartIn =='Revision')
                                <td class="bg-info text-light">{{$list[0]->firstApprovalPartIn}}</td>
                            @elseif ($list[0]->firstApprovalPartIn =='Updated By User')
                                <td class="bg-primary text-light">{{$list[0]->firstApprovalPartIn}}</td>
                            @elseif ($list[0]->firstApprovalPartIn =='Reject')
                                <td class="bg-danger text-light">{{$list[0]->firstApprovalPartIn}}</td>
                            @else
                                <td class="bg-success">{{$list[0]->firstApprovalPartIn}}</td>
                    @endif
                    <td>Cek Validitas Dokumen (ADMIN)</td>
                    @if (is_null($list[0]->nameFirstApprovalPartIn))
                        <td>Belum Ada Penanggung Jawab</td>
                    @else
                        <td>{{$list[0]->nameFirstApprovalPartIn}}</td>
                    @endif
                    
                </tr>
                <tr>
                    <td>3</td>
                    <td>{{$list[0]->timeThirdApprovalDocsPartIn}}</td>
                     @if ($list[0]->thirdApprovalDocsPartIn =='Waiting For Approval')
                                <td class="bg-warning text-light">{{$list[0]->thirdApprovalDocsPartIn}}</td>
                            @elseif ($list[0]->thirdApprovalDocsPartIn =='Revision')
                                <td class="bg-info text-light">{{$list[0]->thirdApprovalDocsPartIn}}</td>
                            @elseif ($list[0]->thirdApprovalDocsPartIn =='Updated By User')
                                <td class="bg-primary text-light">{{$list[0]->thirdApprovalDocsPartIn}}</td>
                            @elseif ($list[0]->thirdApprovalDocsPartIn =='Reject')
                                <td class="bg-danger text-light">{{$list[0]->thirdApprovalDocsPartIn}}</td>
                            @else
                                <td class="bg-success">{{$list[0]->thirdApprovalDocsPartIn}}</td>
                    @endif
                    <td>Cek Validitas Dokumen (HEAD)</td>
                    @if (is_null($list[0]->nameThirdApprovalDocsPartIn))
                        <td>Belum Ada Penanggung Jawab</td>
                    @else
                        <td>{{$list[0]->nameThirdApprovalDocsPartIn}}</td>
                    @endif
                    
                </tr>
                <tr>
                    <td>4</td>
                    <td>{{$list[0]->timeSecondApprovalPartIn}}</td>
                     @if ($list[0]->secondApprovalPartIn =='Waiting For Approval')
                                <td class="bg-warning text-light">{{$list[0]->secondApprovalPartIn}}</td>
                            @elseif ($list[0]->secondApprovalPartIn =='Revision')
                                <td class="bg-info text-light">{{$list[0]->secondApprovalPartIn}}</td>
                            @elseif ($list[0]->secondApprovalPartIn =='Updated By User')
                                 <td class="bg-primary text-light">{{$list[0]->secondApprovalPartIn}}</td>   
                            @elseif ($list[0]->secondApprovalPartIn =='Reject')
                                <td class="bg-danger text-light">{{$list[0]->secondApprovalPartIn}}</td>
                            @else
                                <td class="bg-success">{{$list[0]->secondApprovalPartIn}}</td>
                    @endif
                    <td>Cek Fisik (ADMIN)</td>
                    @if (is_null($list[0]->nameSecondApprovalPartIn))
                        <td>Belum Ada Penanggung Jawab</td>
                    @else
                        <td>{{$list[0]->nameSecondApprovalPartIn}}</td>
                    @endif
                    
                    
                </tr>
                <tr>
                    <td>5</td>
                    <td>{{$list[0]->timeThirdApprovalPartIn}}</td>
                     @if ($list[0]->thirdApprovalPartIn =='Waiting For Approval')
                                <td class="bg-warning text-light">{{$list[0]->thirdApprovalPartIn}}</td>
                            @elseif ($list[0]->thirdApprovalPartIn =='Revision')
                                <td class="bg-info text-light">{{$list[0]->thirdApprovalPartIn}}</td>
                            @elseif ($list[0]->thirdApprovalPartIn =='Reject')
                                <td class="bg-danger text-light">{{$list[0]->thirdApprovalPartIn}}</td>
                            @else
                                <td class="bg-success">{{$list[0]->thirdApprovalPartIn}}</td>
                    @endif
                    <td>Aprroval Head of User</td>
                    @if (is_null($list[0]->nameThirdApprovalPartIn))
                        <td>Belum Ada Penanggung Jawab</td>
                    @else
                        <td>{{$list[0]->nameThirdApprovalPartIn}}</td>
                    @endif
                   
                    
                </tr>
                <tr>
                    <td>6</td>
                    <td>{{$list[0]->timeFourthApprovalPartIn}}</td>
                     @if ($list[0]->fourthApprovalPartIn =='Waiting For Approval')
                                <td class="bg-warning text-light">{{$list[0]->fourthApprovalPartIn}}</td>
                            @elseif ($list[0]->fourthApprovalPartIn =='Revision')
                                <td class="bg-info text-light">{{$list[0]->fourthApprovalPartIn}}</td>
                            @elseif ($list[0]->fourthApprovalPartIn =='Reject')
                                <td class="bg-danger text-light">{{$list[0]->fourthApprovalPartIn}}</td>
                            @else
                                <td class="bg-success">{{$list[0]->fourthApprovalPartIn}}</td>
                    @endif
                    <td>Approval Head of Procurement</td>
                    @if (is_null($list[0]->nameFourthApprovalPartIn))
                        <td>Belum Ada Penanggung Jawab</td>
                    @else
                        <td>{{$list[0]->nameFourthApprovalPartIn}}</td>
                    @endif
                    
                </tr>
             </tbody>
        </table>
    </div>



{{-- TODO:TABEL 2 --}}
<div class="table-responsive-sm mt-3">
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
                <th scope="col">Detail</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($list as $data)
            <tr>
                <td scope="row">{{$loop->iteration}}</td>
                <td>{{$data->noPart}}</td>
                <td>{{$data->namaPart}}</td>
                <td>{{$data->qtyStockPartIn}}</td>
                <td>{{$data->size}}</td>
                <td>{{$data->satuanPart}}</td>
                <td>{{$data->priceStockPartIn}}</td>
                <td>{{$data->needsStockPartIn}}</td>
                <td>
                    <a type="button" class="btn btn-sm blueDetail margin-button"
                    href="{{ url('/flowIn' . ucwords($data->kategoriPart) . '-detail/' . $data->id_flowInPart) }}">
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

@php 
$arrayOfId = array(); foreach ($list as $data) {
array_push($arrayOfId,$data->id_flowInPart); 
} // json_encode($arrayOfId);
@endphp
    @if (auth()->user()->role == 'head')
    <form action="{{ url('/approveFlowInFinalHead') }}" method="post">
            @csrf 
            @foreach($arrayOfId as $id)
            <input type="hidden" name="arrayOfId[]" value="{{$id}}">
            @endforeach
            <div class="mt-3">
                <button
                    onclick="if (confirm('Yakin Approve Request ini?')){return true;}else{event.stopPropagation(); event.preventDefault();};"
                    class="btn btn-sm greenAdd margin-button col-12"
                    type="submit">Approve Final (Head)
                </button>
            </div>
    </form>
    @endif
    @if (auth()->user()->role == 'master')
    <form action="{{ url('/approveFlowInFinalMaster') }}" method="post">
            @csrf 
            @foreach($arrayOfId as $id)
            <input type="hidden" name="arrayOfId[]" value="{{$id}}">
            @endforeach
            <div class="mt-3">
                <button
                    onclick="if (confirm('Yakin Approve Request ini?')){return true;}else{event.stopPropagation(); event.preventDefault();};"
                    class="btn btn-sm greenAdd margin-button col-12"
                    type="submit">Approve Final (Master)
                </button>
            </div>
    </form>
    @endif

{{-- TODO:TABEL 3 --}}
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
                        @if (empty($data->filePhotoPartIn) && empty($data->filePO) && empty($data->fileBAST))
                            <p>Data Dokumen Tidak ada</p>
                        @endif
                        @if (!empty($data->filePhotoPartIn))
                        <a type="button" class="btn btn-sm greenAcc margin-button" 
                        href="{{ asset('data/'.$data->filePhotoPartIn) }}">Foto {{$data->namaPart}}</a> 
                        @endif
                        @if (!empty($data->filePO))
                        <a type="button" class="btn btn-sm greenAcc margin-button" 
                        href="{{ asset('data/'.$data->filePO) }}" target="_blank">PO {{$data->namaPart}}</a>
                        @endif
                        @if (!empty($data->fileBAST))
                        <a type="button" class="btn btn-sm greenAcc margin-button" 
                        href="{{ asset('data/'.$data->fileBAST) }}" target="_blank">BAST {{$data->namaPart}}</a>
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