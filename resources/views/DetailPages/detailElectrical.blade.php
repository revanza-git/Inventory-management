@extends('layouts.sidebar')

@section('content')
<h1>Detail Stok Electrical Masuk</h1>
<div class="table-responsive-sm">
    <table class="table table-bordered table-hover mt-2">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Nama Part</th>
                <th scope="col">Nomor Part</th>
                <th scope="col">Quantity In</th>
                <th scope="col">No FTB</th>
            </tr>
        </thead>
        <tbody>
       
            @foreach ($electricalDetail as $data)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$data->namaElectPart}}</td>
                            <td>{{$data->noPartElect}}</td>
                            <td>
                                <ul>
                                @foreach($data->flowInElectrical as $flow)
                                <li>{{ $flow['qtyStockElectIn']; }} </li>
                                @endforeach
                                </ul>
                            </td>
                             <td>
                                <ul>
                                @foreach($data->flowInElectrical as $flow)
                                <li>{{ $flow['noFtb']; }}</li>
                                @endforeach
                                </ul>
                            </td>
                        </tr>
            @endforeach
            
        </tbody>
    </table>
</div>
@endsection