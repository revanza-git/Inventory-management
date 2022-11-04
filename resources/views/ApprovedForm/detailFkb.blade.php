@extends('layouts.sidebar')
@section('content')

{{-- {{dd($list);}} --}}
<h1>Formulir Keluar Barang</h1>
@if($list[0]->kategoriMaterial=='stock')
<h5>Material Persediaan ({{ucwords($list[0]->kategoriMaterial)}}) {{$list[0]->lokasiPart}}</h5>
@elseif($list[0]->kategoriMaterial=='surplus')
<h5>Material Projek ({{ucwords($list[0]->kategoriMaterial)}}) {{$list[0]->lokasiPart}}</h5>
@elseif($list[0]->kategoriMaterial=='rongsokan')
<h5>Material ({{ucwords($list[0]->kategoriMaterial)}}) {{$list[0]->lokasiPart}}</h5>
@elseif($list[0]->kategoriMaterial=='dead')
<h5>Material Persediaan Mati ({{ucwords($list[0]->kategoriMaterial)}}) {{$list[0]->lokasiPart}}</h5>
@elseif($list[0]->kategoriMaterial=='charges')
<h5>Material Bukan Persediaan (Direct {{ucwords($list[0]->kategoriMaterial)}}) {{$list[0]->lokasiPart}}</h5>
@endif




@if($list[0]->thirdApprovalPartOut == 'Approved' && $list[0]->fourthApprovalPartOut == 'Approved')
<div class="d-flex align-items-center">
    <form action="{{ url('exportFkb') }}" method="post">
        @csrf
        <input type="hidden" name="noFkb" value="{{$noFkb}}">
        <input type="hidden" name="name" value="{{$name}}">
        <input type="hidden" name="department" value="{{$department}}">
        <button class="btn btn-sm orangeEdit margin-button" type="submit"> 
            <i class="bi bi-download"></i> PDF
        </button>
    </form>

    <form action="{{ url('exportHistoryFkb') }}" method="post">
        @csrf
        <input type="hidden" name="noFkb" value="{{$noFkb}}">
        <input type="hidden" name="dtStockPartOut" value="{{$list[0]->dtStockPartOut}}">
        <input type="hidden" name="name" value="{{$name}}">
        <input type="hidden" name="department" value="{{$department}}">
        <input type="hidden" name="tanggalFkb" value="{{$list[0]->dtStockPartApprovedOut}}">
        <button class="btn btn-sm greenAcc margin-button"  style="display: inline-block;" type="submit"> 
            <i class="bi bi-clock-history"></i> History
        </button>
    </form>
</div>

@endif

@if($list[0]->thirdApprovalPartOut != 'Approved' || $list[0]->fourthApprovalPartOut != 'Approved')
<div class="alert alert-primary d-flex align-items-center" role="alert">
  <i class="bi bi-info-circle"></i>
  <div style="margin-left: 5px;">
    Form Ini sedang proses Final Approval dari Head of User atau Head Of Procurement
  </div>
</div>
@endif


<div class="card col-8 mt-3 cardHeadCustom">
            <div class="card-body">
                <h4 class="card-title">Detail Request</h4>
                <ol>
                    <li><h6 class="card-subtitle mt-2 text-white">Tanggal Pengajuan : 
                        {{Carbon\Carbon::parse($list[0]->dtStockPartOut)->isoFormat('LL');}}</h6></li>
                    <li><h6 class="card-subtitle mt-2 text-white">Nama Requester : {{$name}}</h6></li>
                    <li><h6 class="card-subtitle mt-2 text-white">Dept.Requester : Dept.{{$department}}</h6></li>
                    <li><h6 class="card-subtitle mt-2 text-white">Lokasi : {{$list[0]->lokasiPart}}</h6></li>
                    <li><h6 class="card-subtitle mt-2 text-white">FTB: {{$noFkb}}</h6></li>
                    <li><h6 class="card-subtitle mt-2 text-white">Tanggal FTB : 
                        {{Carbon\Carbon::parse($list[0]->dtStockPartApprovedOut)->isoFormat('LL');}}</h6></li>
                </ol>
                
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
                    <td>{{Carbon\Carbon::parse($list[0]->dtStockPartOut)->format('d, M Y');}}</td>
                    <td class="bg-success">Done</td>
                    <td>Request</td>
                    <td>{{$name}}</td>  
                </tr>
                <tr>
                    <td>2</td>
                    <td>{{$list[0]->timeFirstApprovalPartOut}}</td>
                    <td class="bg-success">{{$list[0]->firstApprovalPartOut}}</td>
                    <td>Cek Validitas Dokumen</td>
                    <td>{{$list[0]->nameFirstApprovalPartOut}}</td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>{{$list[0]->timeThirdApprovalDocsPartOut}}</td>
                    <td class="bg-success">{{$list[0]->thirdApprovalDocsPartOut}}</td>
                    <td>Cek Validitas Dokumen (HEAD)</td>
                    <td>{{$list[0]->nameThirdApprovalDocsPartOut}}</td>
                </tr>
                <tr>
                    <td>4</td>
                    <td>{{$list[0]->timeSecondApprovalPartOut}}</td>
                    <td class="bg-success">{{$list[0]->secondApprovalPartOut}}</td>
                    <td>Cek Fisik</td>
                    <td>{{$list[0]->nameSecondApprovalPartOut}}</td>
                </tr>
                <tr>
                    <td>5</td>
                    <td>{{$list[0]->timeFourthApprovalPartOut}}</td>
                    @if ($list[0]->fourthApprovalPartOut =='Waiting For Approval')
                    <td class="bg-warning text-light">{{$list[0]->fourthApprovalPartOut}}</td>
                    @else
                    <td class="bg-success">{{$list[0]->fourthApprovalPartOut}}</td>
                    @endif
                    <td>Approval Head of Procurement</td>
                    <td>{{$list[0]->nameFourthApprovalPartOut}}</td>
                </tr>
                <tr>
                    <td>6</td>
                    <td>{{$list[0]->timeThirdApprovalPartOut}}</td>
                    @if ($list[0]->thirdApprovalPartOut =='Waiting For Approval')
                    <td class="bg-warning text-light">{{$list[0]->thirdApprovalPartOut}}</td>
                    @else
                    <td class="bg-success">{{$list[0]->thirdApprovalPartOut}}</td>
                    @endif
                    <td>Aprroval Head of User</td>
                    <td>{{$list[0]->nameThirdApprovalPartOut}}</td> 
                </tr>
             </tbody>
        </table>
    </div>



{{-- TODO:TABEL 2 --}}
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
                        @if (empty($data->filePhotoPartOut) && empty($data->filePO) && empty($data->fileBAST))
                            <p>Data Dokumen Tidak ada</p>
                        @endif
                        @if (!empty($data->filePhotoPartOut))
                        <a type="button" class="btn btn-sm greenAcc margin-button" 
                        href="{{ asset('data/'.$data->filePhotoPartOut) }}">Foto {{$data->namaPart}}</a> 
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