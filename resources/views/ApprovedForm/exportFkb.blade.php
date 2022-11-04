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
        {{-- TABEL HEADER --}}
        {{-- <hr class="bg-dark border-5 border-top border-dark rule">
        <h2 class="text-center">Formulir Terima Barang</h2>
        <hr class="bg-dark border-5 border-top border-dark rule">  --}}

        <table style="width:100%">
            <tr>
                <td rowspan="2"><img src="{{public_path('nr.png')}}" width="200px" style="display: block"></td>
                <th style="text-align: center;">Formulir Keluar Barang</th>
            </tr>
            <tr>
                @if($list[0]->kategoriMaterial=='stock')
                <th style="text-align: center;">Material Persediaan ({{ucwords($list[0]->kategoriMaterial)}}) {{$list[0]->lokasiPart}}</th>
                @elseif($list[0]->kategoriMaterial=='surplus')
                <th style="text-align: center;">Material Projek ({{ucwords($list[0]->kategoriMaterial)}}) {{$list[0]->lokasiPart}}</th>
                @elseif($list[0]->kategoriMaterial=='rongsokan')
                <th style="text-align: center;">Material ({{ucwords($list[0]->kategoriMaterial)}}) {{$list[0]->lokasiPart}}</th>
                @elseif($list[0]->kategoriMaterial=='dead')
                <th style="text-align: center;">Material Persediaan Mati ({{ucwords($list[0]->kategoriMaterial)}}) {{$list[0]->lokasiPart}}</th>
                @elseif($list[0]->kategoriMaterial=='charges')
                <th style="text-align: center;">Material Bukan Persediaan (Direct {{ucwords($list[0]->kategoriMaterial)}}) {{$list[0]->lokasiPart}}</th>
                @endif
            </tr>
        </table>

        <div class="card col-8 mt-3 ">
                    <div class="card-body">
                        {{-- <h4 class="card-title">Detail Request</h4> --}}
                        <ol>
                            {{-- <li><h6 class="card-subtitle mt-2 text-white">Tanggal Pengajuan : 
                            {{Carbon\Carbon::parse($list[0]->dtStockPartOut)->isoFormat('LL');}}</h6></li>
                            <li><h6 class="card-subtitle mt-2 text-white">Nama Requester : {{$name}}</h6></li> --}}
                            <li><h6 class="card-subtitle mt-2 text-white">Departemen/Penyedia B/J : Dept.{{$department}}</h6></li>
                            <li><h6 class="card-subtitle mt-2 text-white">No Terima Barang: {{$noFkb}}</h6></li>
                            <li><h6 class="card-subtitle mt-2 text-white">Tanggal Terima: {{Carbon\Carbon::parse($list[0]->dtStockPartApprovedOut)->isoFormat('LL');}}</h6></li>
                        </ol>
                        
                    </div>
        </div>

        {{-- TODO:TABEL 2 --}}
        <div class="table-responsive-sm mt-4">
            <table id="tableFormCustom"  style="width:100%">
                <thead>
                    <tr> 
                        <th scope="col" colspan="11" class="text-center" style="background-color: #293462;color:white">Detail Form</th> 
                    </tr>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">No Part</th>
                        <th scope="col">Size</th>
                        <th scope="col">Nama Barang</th>
                        <th scope="col">Jumlah</th>
                        <th scope="col">Satuan</th>
                        <th scope="col">Harga</th>
                        <th scope="col">Harga Total</th>
                        <th scope="col">Tahun Perolehan</th>
                        <th scope="col">Keperluan</th>
                        <th scope="col">Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($list as $data)
                        @php
                        // KONVERSI RUPIAH
                        $angka = $data->priceStockPartOut;
                        $total = $data->priceStockPartOut * $data->qtyStockPartOut;
                        // dd($total);
                        $hasil_rupiah = "Rp " . number_format($angka,2,',','.');
                        $total ="Rp " . number_format($total,2,',','.');     
                        @endphp
                        
                    <tr>
                        <td scope="row">{{$loop->iteration}}</td>
                        <td>{{$data->noPart}}</td>
                        <td>{{$data->size}}</td>
                        <td>{{$data->namaPart}}</td>
                        <td>{{$data->qtyStockPartOut}}</td>
                        <td>{{$data->satuanPart}}</td>
                        <td>{{$data->priceStockPartOut}}</td>
                        <td>{{$total}}</td>
                        <td>{{$data->yearStockPartOut}}</td>
                        <td>{{$data->needsStockPartOut}}</td>
                        <td>{{$data->notesPartOut}}</td>
                    </tr>
                    @empty
                    <td colspan="8" class="text-center">
                        Tidak ada Data
                    </td>
                    @endforelse
                </tbody>
            </table>
        </div>
    
        {{-- TABEL TTD --}}
        <div class="mt-3">
                        <table style="width:100%">
                            <thead>  
                                <tr>
                                <th scope="col" colspan="2" class="text-center" style="background-color: #293462;color:white">Pengguna/Pemilik Barang</th>
                                <th scope="col" colspan="2" class="text-center" style="background-color: #0096FF;color:white">Fungsi Gudang</th>    
                                </tr>
                                <tr>
                                        <td scope="col" style="padding-right:50px;">Requester</th>
                                        <td scope="col" style="padding-right:50px;">Diserahkan</th>
                                        <td scope="col" style="padding-right:50px;">Diperiksa</th>
                                        <td scope="col" style="padding-right:50px;">Diterima</th> 
                                </tr>   
                                <tr>
                                        <td scope="col" style="padding-right:50px;">Departement {{$department}}</th>
                                        <td scope="col" style="padding-right:50px;">Kepala Dept.{{$department}}</th>
                                        <td scope="col" style="padding-right:50px;">Admin Warehouse</th>
                                        <td scope="col" style="padding-right:50px;">Kepala Dept.Procurement</th>   
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="customTd"><img src="{{public_path('data/'.$list[0]->signatureUser)}}" width="100px"></td>
                                    <td class="customTd"><img src="{{public_path('data/'.$list[0]->signatureHead)}}" width="100px"></td>
                                    <td class="customTd"><img src="{{public_path('data/'.$list[0]->signatureAdmin)}}" width="100px"></td>
                                    <td class="customTd"><img src="{{public_path('data/'.$list[0]->signatureMaster)}}" width="100px"></td>
                                </tr>
                                <tr>
                                    <td style="padding-right:50px;">{{$name}}</td>
                                    <td style="padding-right:50px;">{{$list[0]->nameThirdApprovalPartOut}}</td>
                                    <td style="padding-right:50px;">{{$list[0]->nameFirstApprovalPartOut}}</td>
                                    <td style="padding-right:50px;">{{$list[0]->nameFourthApprovalPartOut}}</td>
                                </tr>
                            </tbody>
                        </table>
                
            
        </div>
    </div>
</body>
</html>