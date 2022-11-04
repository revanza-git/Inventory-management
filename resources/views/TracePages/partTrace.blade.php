@extends('layouts.sidebar')
@section('content')


    <h3>Data Trace Periode {{Carbon\Carbon::parse($firstRange)->isoFormat('LL');}} - {{Carbon\Carbon::parse($secondRange)->isoFormat('LL');}}<h3>

<div  style="margin-top:25px">
        <h5 style="margin-bottom: 25px ; background-color: #293462 ; color:white;">
            Saldo Sebelum Periode Yang dipilih : {{$totalSumBeforeRange}}</h5>
        <div class="table-responsive-sm">
            <table  id="traceTable" class="table table-bordered table-hover mt-2 table-sm table-striped"
            >
                <thead style="font-size: 25px">
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Tanggal</th>
                        <th scope="col">Saldo Awal</th>
                        <th scope="col">No FTB</th>
                        <th scope="col" style="background-color:#14C38E; color:white">Quantity In</th>
                        <th scope="col">No FKB</th>
                        <th scope="col" style="background-color:#D61C4E;color:white ">Quantity Out</th>
                        <th scope="col">Saldo Akhir</th>
                    </tr>
                </thead>
                <tbody style="font-size: 20px">
                    @php
                        $total=$totalSumBeforeRange;
                        $saldoAwal = array($total);
                        $i=0;

                    @endphp

                    @foreach($tableFinal as $data)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{Carbon\Carbon::parse($data->date)->isoFormat('LL');}}</td>
                        <td>{{$saldoAwal[$i]}}</td>
                        <td>{{$data->noFTB}}</td>
                        <td>{{$data->IN}}</td>
                        <td>{{$data->noFKB}}</td>
                        <td>{{$data->OUT}}</td>
                        @php
                        $total+=$data->SALDO;
                        array_push($saldoAwal,$total);
                        @endphp
                        <td>{{$total}}</td>

                        @php
                            $i++;
                        @endphp
                    </tr>
                    @endforeach
                   
                </tbody>
            </table>
            <h5 class="mt-3" style="background-color: #293462 ; color:white;">Saldo Akhir : {{$total}} </h5>

        </div>
</div>  
    
@endsection