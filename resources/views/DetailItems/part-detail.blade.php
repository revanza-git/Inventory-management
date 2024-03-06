@extends('layouts.sidebar')
@section('content')
  {{-- {{dd($records);}}   --}}
  @if(Session::has('status')||Session::has('statusPlusStockElect')
    ||Session::has('statusMinusStockElect')||Session::has('statusUpdateElectrical'))
    <div class="alert greenAdd" role="alert" id="box">
        <div>{{Session::get('message')}}</div>
    </div>
  @endif
    <h1>Data {{$records->namaPart}}</h1>
    <hr class="bg-dark border-5 border-top border-dark rule">

    <div class="mt-4">
        @if($currenttotal>0)
        <div class="mb-1 greenAdd" style="text-align: center; border-radius:10px">
                <label style="display: inline-block; font-weight:bold;">Stok Sekarang :</label>
                <p style="display: inline-block; margin-left:5px; color:white;">{{$currenttotal}}</p>
        </div>
        @else
        <div class="mb-1 redAdd" style="text-align: center;border-radius:10px">
                <label style="display: inline-block; font-weight:bold;">Stok Sekarang :</label>
                <p style="display: inline-block; margin-left:5px; color:white;">{{$currenttotal}}</p>
        </div>
        @endif

        <div class="mb-1">
            <label style="display: inline-block; font-weight:bold;">Nama Part :</label>
            <p style="display: inline-block; margin-left:5px; color:black;">{{ucwords($records->namaPart)}}</p>
        </div>

        <div class="mb-1">
            <label style="display: inline-block; font-weight:bold;">Kategori Material :</label>
                @if($records->kategoriMaterial=='stock')
                <p style="display: inline-block; margin-left:5px; color:black;">Material Persediaan ({{ucwords($records->kategoriMaterial)}})</p>
                @elseif($records->kategoriMaterial=='surplus')
                <p style="display: inline-block; margin-left:5px; color:black;">Material Projek ({{ucwords($records->kategoriMaterial)}})</p>
                @elseif($records->kategoriMaterial=='rongsokan')
                <p style="display: inline-block; margin-left:5px; color:black;">Material ({{ucwords($records->kategoriMaterial)}})</p>
                @elseif($records->kategoriMaterial=='dead')
                <p style="display: inline-block; margin-left:5px; color:black;">Material Persediaan Mati ({{ucwords($records->kategoriMaterial)}})</p>
                @elseif($records->kategoriMaterial=='charges')
                <p style="display: inline-block; margin-left:5px; color:black;">Material Bukan Persediaan (Direct {{ucwords($records->kategoriMaterial)}})</p>
                @endif
            
        </div>
        <div class="mb-1">
            <label style="display: inline-block; font-weight:bold;">Deskripsi Part :</label>
            <p style="display: inline-block; margin-left:5px; color:black;">{{ucwords($records->descPart)}}</p>
        </div>
        <div class="mb-1">
            <label style="display: inline-block; font-weight:bold;">Lokasi :</label>
            <p style="display: inline-block; margin-left:5px; color:black;">{{ucwords($records->lokasiPart)}}</p>
        </div>
       
        @if(isset($records->size))
        <div class="mb-1">
            <label style="display: inline-block; font-weight:bold;">Size :</label>
            <p style="display: inline-block; margin-left:5px; color:black;">{{$records->size}}</p>
        </div>
        @endif
        <div class="mb-1" style="display: inline">
            <label style="display: inline-block; font-weight:bold;">Satuan :</label>
            <p style="display: inline-block; margin-left:5px; color:black;">{{$records->satuanPart}}</p>
        </div>
        @if(isset($records->keterangan))
        <div class="mb-1">
            <label style="display: inline-block; font-weight:bold;">Keterangan :</label>
            <p style="display: inline-block; margin-left:5px; color:black;">{{$records->keterangan}}</p>
        </div>
        @endif

        {{-- TRACE DATA PER BULAN --}}
        <div class="mt-2 col-3 ">
        <form action="/{{$records->kategoriPart}}-trace/{{$records->idPart}}" method="POST">
        @csrf
        <label >Trace Data :</label>
        <div class="form-floating mb-3">
                <input type="date" class="form-control" id="floatingInput" name="dtFirstRange" required>
                <label for="floatingInput">Date From :</label>
        </div>
        <div class="form-floating mb-3">
                <input type="date" class="form-control" id="floatingInput" name="dtSecondRange" required >
                <label for="floatingInput">Date To :</label>
        </div> 

        <div class="mb-3">
            <button class="btn btn-sm greenAdd" type="submit">Lihat Data</button>
        </div>

        </form>
        </div> 


        {{-- TABEL RECORDS STOK MASUK ITEM  --}}
     <div class="mt-4">
        <hr class="bg-success border-5 border-top border-success mt-3">
        <h3>Request Stock (IN)</h3>
        <hr class="bg-dark border-5 border-top border-success">
        
        <div class="table-responsive-sm">

            <table  id="tableIn" class="table table-bordered table-hover mt-2 table-striped">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Date In</th>
                        <th scope="col">No Part</th>
                        <th scope="col">Quantity In</th>
                        <th scope="col">Cek Dokumen</th>
                        <th scope="col">Cek Fisik</th>
                        <th scope="col">Head of User</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- <td>{{$records->flowInElectrical}}</td> --}}
                    @foreach ($flowInRecords as $data)
                    <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{Carbon\Carbon::parse($data->dtStockPartIn)->isoFormat('LL');}}</td>
                            <td>{{$data->noPart}}</td>
                            <td>{{$data->qtyStockPartIn}}</td>

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

                            @if ($data->thirdApprovalPartIn =='Waiting For Approval')
                                <td class="bg-warning text-light">{{$data->thirdApprovalPartIn}}</td>
                            @elseif ($data->thirdApprovalPartIn =='Revision')
                                <td class="bg-info text-light">{{$data->thirdApprovalPartIn}}</td>
                            @elseif ($data->thirdApprovalPartIn =='Reject')
                                <td class="bg-danger text-light">{{$data->thirdApprovalPartIn}}</td>
                            @else
                                <td class="bg-success">{{$data->thirdApprovalPartIn}}</td>
                            @endif
                            <td>   
                                <a type="button" class="btn btn-sm blueDetail margin-button"
                                href="/flowIn{{ucwords($category)}}-detail/{{$data->id_flowInPart}}">
                                Detail
                                </a>
                            </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
     

        </div>
    </div>   


        {{-- TABEL RECORDS STOK KELUAR ITEM  --}}
        <hr class="bg-danger border-5 border-top border-danger">
        <h3>Request Stock (OUT)</h3>
        <hr class="bg-danger border-5 border-top border-danger">

        <div class="table-responsive-sm">
            <table id="tableOut" class="table table-bordered table-hover mt-2 table-striped">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Date Out</th>
                        <th scope="col">No Part</th>
                        <th scope="col">Quantity Out</th>
                        <th scope="col">Validitas Dokumen</th>
                        <th scope="col">Cek Fisik</th>
                        <th scope="col">Head of User</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($flowOutRecords as $data)
                    <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{Carbon\Carbon::parse($data->dtStockPartOut)->isoFormat('LL');}}</td>
                            <td>{{$data->noPart}}</td>
                            <td>{{$data->qtyStockPartOut}}</td>
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

                            @if ($data->thirdApprovalPartOut =='Waiting For Approval')
                                <td class="bg-warning text-light">{{$data->thirdApprovalPartOut}}</td>
                            @elseif ($data->thirdApprovalPartOut =='Revision')
                                <td class="bg-info text-light">{{$data->thirdApprovalPartOut}}</td>
                            @elseif ($data->thirdApprovalPartOut =='Reject')
                                <td class="bg-danger text-light">{{$data->thirdApprovalPartOut}}</td>
                            @else
                                <td class="bg-success">{{$data->thirdApprovalPartOut}}</td>
                            @endif
                            <td>   
                                <a type="button" class="btn btn-sm blueDetail margin-button"
                                href="/flowOut{{ucwords($category)}}-detail/{{$data->id_flowOutPart}}">
                                Detail
                                </a>
                            </td>
                           
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

</div>  

@endsection