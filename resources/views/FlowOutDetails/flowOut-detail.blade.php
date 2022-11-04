@extends('layouts.sidebar')
@section('content')
{{-- {{dd($data)}}; --}}
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
                    <td>{{$nama}}</td>
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
                        href="{{ asset('data/'.$data->filePO) }}" target="_blank">
                        <i class="bi bi-file-earmark-pdf-fill"></i></a>
                        @endif
                        @if (!empty($data->fileBAST))
                        <a type="button" class="btn btn-sm greenAcc margin-button" 
                        href="{{ asset('data/'.$data->fileBAST) }}" target="_blank">
                        <i class="bi bi-file-earmark-pdf-fill"></i></a>
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
                    <td> {{Carbon\Carbon::parse($data->dtStockPartOut)->format('d, M Y');}}</td>
                    @if (($data->firstApprovalPartOut=='Approved') &&($data->secondApprovalPartOut=='Approved')
                        &&($data->thirdApprovalPartOut=='Approved') &&($data->fourthApprovalPartOut=='Approved')) 
                        <td class="bg-success">Done</td>
                    @else
                        <td>Pending</td>
                    @endif
                    <td>Request</td>
                    <td>{{$data->nameRequester}}</td>
                    
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
                    <td>Cek Validitas Dokumen (ADMIN)</td>
                    @if (is_null($data->nameFirstApprovalPartOut))
                        <td>Belum Ada Penanggung Jawab</td>
                    @else
                        <td>{{$data->nameFirstApprovalPartOut}}</td>
                    @endif
                    
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
                    @if (is_null($data->nameThirdApprovalDocsPartOut))
                        <td>Belum Ada Penanggung Jawab</td>
                    @else
                        <td>{{$data->nameThirdApprovalDocsPartOut}}</td>
                    @endif
                    
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
                    <td>Cek Fisik (ADMIN)</td>
                    @if (is_null($data->nameSecondApprovalPartOut))
                        <td>Belum Ada Penanggung Jawab</td>
                    @else
                        <td>{{$data->nameSecondApprovalPartOut}}</td>
                    @endif
                    
                    
                </tr>
                <tr>
                    <td>5</td>
                    <td>{{$data->timeFourthApprovalPartOut}}</td>
                     @if ($data->fourthApprovalPartOut =='Waiting For Approval')
                                <td class="bg-warning text-light">{{$data->fourthApprovalPartOut}}</td>
                            @elseif ($data->fourthApprovalPartOut =='Revision')
                                <td class="bg-info text-light">{{$data->fourthApprovalPartOut}}</td>
                            @elseif ($data->fourthApprovalPartOut =='Reject')
                                <td class="bg-danger text-light">{{$data->fourthApprovalPartOut}}</td>
                            @else
                                <td class="bg-success">{{$data->fourthApprovalPartOut}}</td>
                    @endif
                    <td>Approval Head of Procurement</td>
                    @if (is_null($data->nameFourthApprovalPartOut))
                        <td>Belum Ada Penanggung Jawab</td>
                    @else
                        <td>{{$data->nameFourthApprovalPartOut}}</td>
                    @endif
                             
                </tr>
                <tr>
                    <td>6</td>
                    <td>{{$data->timeThirdApprovalPartOut}}</td>
                     @if ($data->thirdApprovalPartOut =='Waiting For Approval')
                                <td class="bg-warning text-light">{{$data->thirdApprovalPartOut}}</td>
                            @elseif ($data->thirdApprovalPartOut =='Revision')
                                <td class="bg-info text-light">{{$data->thirdApprovalPartOut}}</td>
                            @elseif ($data->thirdApprovalPartOut =='Reject')
                                <td class="bg-danger text-light">{{$data->thirdApprovalPartOut}}</td>
                            @else
                                <td class="bg-success">{{$data->thirdApprovalPartOut}}</td>
                    @endif
                    <td>Aprroval Head of User</td>
                    @if (is_null($data->nameThirdApprovalPartOut))
                        <td>Belum Ada Penanggung Jawab</td>
                    @else
                        <td>{{$data->nameThirdApprovalPartOut}}</td>
                    @endif
                   
                </tr>
             </tbody>
        </table>
    </div>

        @if(!empty($data->ReasonFirstApprovalPartOut) && ($data->firstApprovalPartOut != 'Updated By User'))
            <div class="card col-5 mt-5 bg-info text-white cardCustom">
                <div class="cardCustom">
                    <h5>Alasan Revisi Validitas Dokumen :</h5>
                    <h6 style="margin-left: 20px;">{{$data->ReasonFirstApprovalPartOut}}</h6>
                </div>
            </div>
        @endif    
        @if( !empty($data->ReasonSecondApprovalPartOut) && $data->secondApprovalPartOut != 'Updated By User')
            <div class="card col-5 mt-5 bg-info text-white cardCustom">
                <div class="cardCustom">
                    <h5>Alasan Revisi Cek Fisik :</h5>
                    <h6 style="margin-left: 20px;">{{$data->ReasonSecondApprovalPartOut}}</h6>
                </div>
            </div>
        @endif
        
    </div>
</div>    
@endsection