@extends('layouts.sidebar')
@section('content')
{{-- {{dd($data)}}; --}}
@php
    // KONVERSI RUPIAH
    $angka = $data->priceStockPartIn;
    $total = $data->priceStockPartIn * $data->qtyStockPartIn;
    // dd($total);
    $hasil_rupiah = "Rp " . number_format($angka,2,',','.');
    $total ="Rp " . number_format($total,2,',','.');     


    
@endphp
@if (session()->has('success'))
    <div class="alert greenAdd" role="alert" id="box">
        <div>{{session('success')}}</div>
    </div>
@endif
<h2>Detail Terima Barang {{$category}} dengan No Part {{$data->noPart}}</h2>
<hr class="bg-dark border-5 border-top border-dark rule">


<h5>Departement Requester : {{$data->departmentRequester}}</h5>
      
<div class="mt-4">
    <h5>No FTB :</h5>
    <div class="mb-1 col-5">
           <input type="text" class="form-control" id="floatingInput" 
           placeholder="No Ftb" value="{{$data->noFtb}}" name="noFtb" disabled>
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
                    <td>{{$nama}}</td>
                    <td>{{$data->noPart}}</td>
                    <td>{{$data->qtyStockPartIn}}</td>
                    <td>{{$hasil_rupiah}}</td>
                    <td>{{$total}}</td>
                    <td>{{$data->yearStockPartIn}}</td>
                    <td>{{$data->needsStockPartIn}}</td>
                    <td>
                        @if (empty($data->filePhotoPartIn) && empty($data->filePO) && empty($data->fileBAST))
                            <p>Data Dokumen Tidak ada</p>
                        @endif
                        @if (!empty($data->filePhotoPartIn))
                        <a type="button" class="btn btn-sm greenAcc margin-button" 
                        href="{{ asset('data/'.$data->filePhotoPartIn) }}">Foto</a> 
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
            <h6 style="margin-left: 10px">{{$data->notesPartIn}}</h6>
        </div>
    </div>


    <div class="table-responsive-sm mt-3">
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
                    <td> {{Carbon\Carbon::parse($data->dtStockPartIn)->format('d, M Y');}}</td>
                    @if (($data->firstApprovalPartIn=='Approved') &&($data->secondApprovalPartIn=='Approved')
                        &&($data->thirdApprovalPartIn=='Approved') &&($data->fourthApprovalPartIn=='Approved')) 
                        <td class="bg-success">Done</td>
                    @else
                        <td>Pending</td>
                    @endif
                    <td>Request</td>
                    <td>{{$data->nameRequester}}</td>
                    
                </tr>
                <tr>
                    <td>2</td>
                    <td>{{$data->timeFirstApprovalPartIn}}</td>
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
                    <td>Cek Validitas Dokumen (ADMIN)</td>
                    @if (is_null($data->nameFirstApprovalPartIn))
                        <td>Belum Ada Penanggung Jawab</td>
                    @else
                        <td>{{$data->nameFirstApprovalPartIn}}</td>
                    @endif
                    
                </tr>
                <tr>
                    <td>3</td>
                    <td>{{$data->timeThirdApprovalDocsPartIn}}</td>
                     @if ($data->thirdApprovalDocsPartIn =='Waiting For Approval')
                                <td class="bg-warning text-light">{{$data->thirdApprovalDocsPartIn}}</td>
                            @elseif ($data->thirdApprovalDocsPartIn =='Revision')
                                <td class="bg-info text-light">{{$data->thirdApprovalDocsPartIn}}</td>
                            @elseif ($data->thirdApprovalDocsPartIn =='Updated By User')
                                <td class="bg-primary text-light">{{$data->thirdApprovalDocsPartIn}}</td>
                            @elseif ($data->thirdApprovalDocsPartIn =='Reject')
                                <td class="bg-danger text-light">{{$data->thirdApprovalDocsPartIn}}</td>
                            @else
                                <td class="bg-success">{{$data->thirdApprovalDocsPartIn}}</td>
                    @endif
                    <td>Cek Validitas Dokumen (HEAD)</td>
                    @if (is_null($data->nameThirdApprovalDocsPartIn))
                        <td>Belum Ada Penanggung Jawab</td>
                    @else
                        <td>{{$data->nameThirdApprovalDocsPartIn}}</td>
                    @endif
                    
                </tr>
                <tr>
                    <td>4</td>
                    <td>{{$data->timeSecondApprovalPartIn}}</td>
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
                    <td>Cek Fisik (ADMIN)</td>
                    @if (is_null($data->nameSecondApprovalPartIn))
                        <td>Belum Ada Penanggung Jawab</td>
                    @else
                        <td>{{$data->nameSecondApprovalPartIn}}</td>
                    @endif
                    
                    
                </tr>
                <tr>
                    <td>5</td>
                    <td>{{$data->timeThirdApprovalPartIn}}</td>
                     @if ($data->thirdApprovalPartIn =='Waiting For Approval')
                                <td class="bg-warning text-light">{{$data->thirdApprovalPartIn}}</td>
                            @elseif ($data->thirdApprovalPartIn =='Revision')
                                <td class="bg-info text-light">{{$data->thirdApprovalPartIn}}</td>
                            @elseif ($data->thirdApprovalPartIn =='Reject')
                                <td class="bg-danger text-light">{{$data->thirdApprovalPartIn}}</td>
                            @else
                                <td class="bg-success">{{$data->thirdApprovalPartIn}}</td>
                    @endif
                    <td>Aprroval Head of User</td>
                    @if (is_null($data->nameThirdApprovalPartIn))
                        <td>Belum Ada Penanggung Jawab</td>
                    @else
                        <td>{{$data->nameThirdApprovalPartIn}}</td>
                    @endif
                   
                    
                </tr>
                <tr>
                    <td>6</td>
                    <td>{{$data->timeFourthApprovalPartIn}}</td>
                     @if ($data->fourthApprovalPartIn =='Waiting For Approval')
                                <td class="bg-warning text-light">{{$data->fourthApprovalPartIn}}</td>
                            @elseif ($data->fourthApprovalPartIn =='Revision')
                                <td class="bg-info text-light">{{$data->fourthApprovalPartIn}}</td>
                            @elseif ($data->fourthApprovalPartIn =='Reject')
                                <td class="bg-danger text-light">{{$data->fourthApprovalPartIn}}</td>
                            @else
                                <td class="bg-success">{{$data->fourthApprovalPartIn}}</td>
                    @endif
                    <td>Approval Head of Procurement</td>
                    @if (is_null($data->nameFourthApprovalPartIn))
                        <td>Belum Ada Penanggung Jawab</td>
                    @else
                        <td>{{$data->nameFourthApprovalPartIn}}</td>
                    @endif
                    
                </tr>
             </tbody>
        </table>
    </div>

        @if(!empty($data->ReasonFirstApprovalPartIn) && ($data->firstApprovalPartIn != 'Updated By User'))
            <div class="card col-5 mt-5 bg-info text-white cardCustom">
                <div class="cardCustom">
                    <h5>Alasan Revisi Validitas Dokumen :</h5>
                    <h6 style="margin-left: 20px;">{{$data->ReasonFirstApprovalPartIn}}</h6>
                </div>
            </div>
        @endif    
        @if( !empty($data->ReasonSecondApprovalPartIn) && $data->secondApprovalPartIn != 'Updated By User')
            <div class="card col-5 mt-5 bg-info text-white cardCustom">
                <div class="cardCustom">
                    <h5>Alasan Revisi Cek Fisik :</h5>
                    <h6 style="margin-left: 20px;">{{$data->ReasonSecondApprovalPartIn}}</h6>
                </div>
            </div>
        @endif
        
    </div>
</div>    
@endsection