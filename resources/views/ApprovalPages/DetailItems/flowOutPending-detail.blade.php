@extends('layouts.sidebar')
@section('content')
{{-- {{dd($data);}} --}}
@php
    // KONVERSI RUPIAH
    $angka = $data->priceStockPartOut;
    $total = $data->priceStockPartOut * $data->qtyStockPartOut;
    // dd($total);
    $hasil_rupiah = "Rp " . number_format($angka,2,',','.');
    $total ="Rp " . number_format($total,2,',','.');    

    
@endphp
@if (session()->has('success'))
<div class="alert greenAdd" role="alert" id="box">
    <div>{{session('success')}}</div>
</div>
@endif
<h2>Detail Keluar Barang {{$category}} dengan No Part {{$data->noPart}}</h2>
<hr class="bg-dark border-5 border-top border-dark rule">


<h5>Departement Requester : {{$data->departmentRequester}}</h5>
      
<div class="mt-4">
    <h5>No FKB :</h5>
    <div class="mb-1 col-5">
           <input type="text" class="form-control" id="floatingInput" 
           placeholder="No Fkb" value="{{$data->noFkb}}" name="noFkb" disabled>
    </div>
    <p class="mt-3"><strong>Status Barang :</strong> {{$data->status}}</p> 
    <div class="table-responsive-sm mt-3">
        <table id="tableWithoutSearch" class="table table-bordered table-hover mt-2 table-striped">
            <thead>
                <tr> 
                    <th scope="col" colspan="9" class="text-center" style="background-color: #293462;color:white">Detail Barang</th> 
                </tr>
                <tr>
                    <th scope="col">Nama Barang</th>
                    <th scope="col">Nomor Part</th>
                    <th scope="col">Quantity In</th>
                    <th scope="col">Harga Satuan</th>
                    <th scope="col">Total</th>
                    <th scope="col">Tahun Perolehan</th>
                    <th scope="col">Keperluan</th>
                    <th scope="col">Download Dokumen</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{$part->namaPart}}</td>
                    <td>{{$data->noPart}}</td>
                    <td>{{$data->qtyStockPartOut}}</td>
                    <td>{{$hasil_rupiah}}</td>
                    <td>{{$total}}</td>
                    <td>{{$data->yearStockPartOut}}</td>
                    <td>{{$data->needsStockPartOut}}</td>
                    <td>
                        @if (empty($data->filePhotoPartOut) && empty($data->filePO) && empty($data->fileBAST))
                            <p>Data Dokumen Tidak ada</p>
                        @endif
                        @if (!empty($data->filePhotoPartOut))
                        <a type="button" class="btn btn-sm greenAcc margin-button" 
                        href="{{ asset('data/'.$data->filePhotoPartOut) }}">Foto</a> 
                        @endif
                        @if (!empty($data->filePO))
                        <a type="button" class="btn btn-sm greenAcc margin-button" 
                        href="{{ asset('data/'.$data->filePO) }}" target="_blank">PO</a>
                        @endif
                        @if (!empty($data->fileBAST))
                        <a type="button" class="btn btn-sm greenAcc margin-button" 
                        href="{{ asset('data/'.$data->fileBAST) }}" target="_blank">BAST</a>
                        @endif
                    </td>
                </tr>
            </tbody>
        </table>
    </div>        

     <div class="card col-5 mt-3">
        <div class="cardCustom">
            <h5>Keterangan Tambahan:</h5>
            <h6 style="margin-left: 10px">{{$data->notesPartOut}}</h6>
        </div>
    </div>
             
             


    <div class="table-responsive-sm mt-6">
        <table class="table table-bordered table-hover mt-3 table-striped">
             <thead>     
                 <tr>
                        <th scope="col">No</th>
                        <th scope="col">Tanggal</th>
                        <th scope="col">Status</th>
                        <th scope="col">Keterangan Status</th>
                        <th scope="col">PIC</th>
                        <th scope="col">Aksi</th>
                 </tr>
             </thead>
             <tbody>
                <tr>
                    <td>1</td>
                    <td> {{Carbon\Carbon::parse($data->dtStockPartOut)->format('d, M Y');}}</td>
                    @if (($data->firstApprovalPartOut=='Approved') &&($data->secondApprovalPartOut=='Approved')
                        &&($data->thirdApprovalPartOut=='Approved') &&($data->fourthApprovalPartOut=='Approved')) 
                        <td class="bg-success">Done</td>
                    @else
                        <td>Pending</td>
                    @endif
                    <td>Request</td>
                    <td>{{$data->nameRequester}}</td>
                    <td></td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>{{$data->timeFirstApprovalPartOut}}</td>
                     @if ($data->firstApprovalPartOut =='Waiting For Approval')
                                <td class="bg-warning text-light">{{$data->firstApprovalPartOut}}</td>
                            @elseif ($data->firstApprovalPartOut =='Revision')
                                <td class="bg-info text-light">{{$data->firstApprovalPartOut}}</td>
                            @elseif ($data->firstApprovalPartOut =='Updated By User')
                                <td class="bg-primary text-light">{{$data->firstApprovalPartOut}}</td>
                            @elseif ($data->firstApprovalPartOut =='Reject')
                                <td class="bg-danger text-light">{{$data->firstApprovalPartOut}}</td>
                            @else
                                <td class="bg-success">{{$data->firstApprovalPartOut}}</td>
                    @endif
                    <td>Cek Validitas Dokumen</td>
                    <td>{{$data->nameFirstApprovalPartOut}}</td>
                    <td>
                        @if (auth()->user()->role =='admin' && $data->firstApprovalPartOut =! 'Reject')
                            <a type="button" 
                            onclick="if (confirm('Yakin Reject Request ini?')){return true;}else{event.stopPropagation(); event.preventDefault();};"
                            class="btn btn-sm redRej margin-button" 
                            href="/inventory/rejectDokumenOut/{{$data->id_flowOutPart}}">Reject</a>
                        @endif 
                    </td>
                    
                </tr>
                <tr>
                    <td>3</td>
                    <td>{{$data->timeThirdApprovalDocsPartOut}}</td>
                     @if ($data->thirdApprovalDocsPartOut =='Waiting For Approval')
                                <td class="bg-warning text-light">{{$data->thirdApprovalDocsPartOut}}</td>
                            @elseif ($data->thirdApprovalDocsPartOut =='Revision')
                                <td class="bg-info text-light">{{$data->thirdApprovalDocsPartOut}}</td>
                            @elseif ($data->thirdApprovalDocsPartOut =='Updated By User')
                                <td class="bg-primary text-light">{{$data->thirdApprovalDocsPartOut}}</td>    
                            @elseif ($data->thirdApprovalDocsPartOut =='Reject')
                                <td class="bg-danger text-light">{{$data->thirdApprovalDocsPartOut}}</td>
                            @else
                                <td class="bg-success">{{$data->thirdApprovalDocsPartOut}}</td>
                    @endif
                    <td>Cek Validitas Dokumen (HEAD)</td>
                    <td>{{$data->nameThirdApprovalDocsPartOut}}</td>
                    <td>
                    </td>
                    
                </tr>

                <tr>
                    <td>4</td>
                    <td>{{$data->timeSecondApprovalPartOut}}</td>
                     @if ($data->secondApprovalPartOut =='Waiting For Approval')
                                <td class="bg-warning text-light">{{$data->secondApprovalPartOut}}</td>
                            @elseif ($data->secondApprovalPartOut =='Revision')
                                <td class="bg-info text-light">{{$data->secondApprovalPartOut}}</td>
                            @elseif ($data->secondApprovalPartOut =='Updated By User')
                                <td class="bg-primary text-light">{{$data->secondApprovalPartOut}}</td>    
                            @elseif ($data->secondApprovalPartOut =='Reject')
                                <td class="bg-danger text-light">{{$data->secondApprovalPartOut}}</td>
                            @else
                                <td class="bg-success">{{$data->secondApprovalPartOut}}</td>
                    @endif
                    <td>Cek Fisik</td>
                    <td>{{$data->nameSecondApprovalPartOut}}</td>
                    <td>
                    </td>
                    
                </tr>

             </tbody>
        </table>
    </div>
    
        @if( !empty($data->ReasonFirstApprovalPartOut))
            <div class="card col-5 mt-4 bg-info text-white cardCustom" >
                <h5>Preview Revisi Validitas Dokumen :</h5>
                <h6 style="margin-left: 20px;">{{$data->ReasonFirstApprovalPartOut}}</h6>
            </div>
        @endif
        @if( !empty($data->ReasonSecondApprovalPartOut))
            <div class="card col-5 mt-4 bg-info text-white cardCustom">
                <h5>Alasan Revisi Cek Fisik :</h5>
                <h6 style="margin-left: 20px;">{{$data->ReasonSecondApprovalPartOut}}</h6>
            </div>
        @endif
        
    </div>
</div>    
@endsection