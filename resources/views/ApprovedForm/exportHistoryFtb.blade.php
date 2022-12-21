<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{public_path('css/export.css')}}">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">

    <style>
        table, th, td {
        border: 1px solid black;
        border-collapse: collapse;
        }
        .customTd{
        text-align: center;    
        }
    </style>
     {{-- Styling Web --}}
    <link rel="stylesheet" href="{{public_path('css/customWeb.css')}}">
</head>
<body>
    

    {{-- <img src="{{public_path('nr.png')}}" class="rounded" width="200px" style="display: block"> --}}

    
    <div style="padding: 20px">
        

        <table style="width:100%">
            <tr>
                <td rowspan="2"><img src="{{public_path('nr.png')}}" width="200px" style="display: block"></td>
                <th style="text-align: center;">Histori Formulir Terima Barang</th>
            </tr>
            <tr>
                <th style="text-align: center;">No FTB : {{$noFtb}}</th>
            </tr>
        </table>


        {{-- TODO:TABEL 2 --}}
        <div class="table-responsive-sm mt-4">
            <table id="tableFormCustom" class="table table-bordered table-hover mt-5 table-striped">
                <thead>
                    <tr> 
                        <th scope="col" colspan="6" class="text-center" style="background-color: #293462;color:white">Detail Histori</th> 
                    </tr>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nomor Part</th>
                        <th scope="col">Status</th>
                        <th scope="col">Waktu</th>
                        <th scope="col">Keterangan/Alasan</th>
                        <th scope="col">PIC</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td scope="row">1</td>
                        <td scope="row">All Items</td>
                        <td scope="row">Pengajuan Formulir Terima Barang</td>
                        <td>{{Carbon\Carbon::parse($dtStockPartIn)->isoFormat('LL');}}</td>
                        <td>Dept.{{$department}}</td>
                        <td>{{$name}}</td>
                    </tr>
                    @php
                        $lastIteration=0;
                    @endphp
                    @forelse ($list as $data)    
                    <tr>
                        @php
                            $num = 1+$loop->iteration;
                        @endphp
                        <td scope="row">{{$num}}</td>
                        <td>{{$data->noPart}}</td>
                        <td>{{$data->status}}</td>
                        <td>{{$data->timeStatus}}</td>
                        <td>{{$data->reason}}</td>
                        <td>{{$data->name}}</td>
                        @if($loop->last)
                            @php
                                $lastIteration = $num;
                            @endphp
                        @endif
                    </tr>
                    @empty
                    <td colspan="8" class="text-center">
                        Tidak ada Data
                    </td>
                    @endforelse
                    <tr>
                        <td scope="row">{{$lastIteration+1}}</td>
                        <td scope="row">All Items</td>
                        <td scope="row">Nomor Terima Barang Dirilis</td>
                        <td>{{Carbon\Carbon::parse($tanggalFtb)->isoFormat('LL');}}</td>
                        <td></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
        </div>
    
    </div>
</body>
</html>