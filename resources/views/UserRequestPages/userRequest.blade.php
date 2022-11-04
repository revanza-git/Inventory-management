@extends('layouts.sidebar')

@section('content')
<div class="mt-4">
        <hr class="bg-success border-5 border-top border-success mt-3">
        <h3>My Request (IN)</h3>
        <hr class="bg-dark border-5 border-top border-success">
        
        <div class="table-responsive-sm">

            <table  id="tableIn" class="table table-bordered table-hover mt-2 table-striped">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col" class="text-center">Form</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($list as $data)
                    <tr>
                        <td scope="row">{{$loop->iteration}}</td>
                        <td>
                            <a
                                class="linkHeadCustom"
                                href="userPendingFormIn/{{$data->dtStockPartIn}}/{{$data->nameRequester}}/{{$data->lokasiPart}}/{{$data->departmentRequester}}/{{$data->kategoriMaterial}}">
                                Form Pengajuan oleh
                                {{$data->nameRequester}}
                                ({{Carbon\Carbon::parse($data->dtStockPartIn)->isoFormat('LL');}})
                                {{$data->lokasiPart}} ({{$data->kategoriMaterial}})
                            </a>
                        </td>
                    </tr>
                    @empty
                        <td colspan="8" class="text-center">
                            Belum ada Request In
                        </td>
                    @endforelse
                   
                </tbody>
            </table>
     

        </div>
</div>


<div class="mt-4">
        <hr class="bg-danger border-5 border-top border-danger">
        <h3>My Request (OUT)</h3>
        <hr class="bg-danger border-5 border-top border-danger">
        
        <div class="table-responsive-sm">

            <table  id="tableIn" class="table table-bordered table-hover mt-2 table-striped">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col" class="text-center">Form</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($listOut as $data)
                    <tr>
                        <td scope="row">{{$loop->iteration}}</td>
                        <td>
                            <a
                                class="linkHeadCustom"
                                href="userPendingFormOut/{{$data->dtStockPartOut}}/{{$data->nameRequester}}/{{$data->lokasiPart}}/{{$data->departmentRequester}}/{{$data->kategoriMaterial}}">
                                Form Pengajuan oleh
                                {{$data->nameRequester}}
                                ({{Carbon\Carbon::parse($data->dtStockPartOut)->isoFormat('LL');}})
                                {{$data->lokasiPart}} ({{$data->kategoriMaterial}})
                            </a>
                        </td>
                    </tr>
                    @empty
                        <td colspan="8" class="text-center">
                            Belum ada Request In
                        </td>
                    @endforelse
                </tbody>
            </table>
     

        </div>
</div>


@endsection