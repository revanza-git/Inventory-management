@extends('layouts.sidebar') @section('content')
@if(session()->has('success'))
<div class="alert greenAdd" role="alert" id="box">
        <div>{{session('success')}}</div>
    </div>
@endif
<h1>Request Approval In (FISIK)</h1>

<hr class="bg-dark border-5 border-top border-dark rule">
<div class="mt-4">
    <h5>List Form Yang Belum Di Approved :</h5>
    <div class="table-responsive-sm mt-4">
        <table id="myTable" class="table table-bordered table-hover mt-2 table-striped">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col" class="text-center">Form</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($dataset as $data)
                <tr>
                    <td scope="row">{{$loop->iteration}}</td>
                    <td>
                        <a
                            class="linkHeadCustom"
                            href="aprroveInAdminFisik/{{$data->dtStockPartIn}}/{{$data->nameRequester}}/{{$data->lokasiPart}}/{{$data->departmentRequester}}/{{$data->kategoriMaterial}}">
                            Form Pengajuan oleh
                            {{$data->nameRequester}}
                            ({{$data->departmentRequester}}) ({{Carbon\Carbon::parse($data->dtStockPartIn)->isoFormat('LL');}})
                            {{$data->lokasiPart}} ({{$data->kategoriMaterial}})
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
</div>

@endsection