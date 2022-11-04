<div class="table-responsive-sm mt-4">
    <table id="reportTable" class="table table-bordered table-hover mt-2 table-striped">
        <thead>
            <tr>
                <th colspan="11" rowspan="4"></th>
            </tr>
            <tr>
                <th></th>
            </tr>
            <tr>
                <th></th>
            </tr>
            <tr>
                <th></th>
            </tr>
            <tr>
                <th colspan="11" style="text-align:center;"> 
                    @if($material == 'stock')
                        <strong>Laporan Material Persediaan ({{ucwords($material)}}) {{ucwords($category)}} {{ucwords($lokasiPart)}} Periode {{Carbon\Carbon::parse($firstRange)->isoFormat('LL');}} - {{Carbon\Carbon::parse($secondRange)->isoFormat('LL');}} </strong>
                    @elseif($material == 'surplus')
                        <strong>Laporan Material Projek / ({{ucwords($material)}}) Projek {{ucwords($category)}} {{ucwords($lokasiPart)}} Periode {{Carbon\Carbon::parse($firstRange)->isoFormat('LL');}} - {{Carbon\Carbon::parse($secondRange)->isoFormat('LL');}} </strong>
                    @elseif($material == 'dead')
                        <strong>Laporan Material Persediaan Mati / ({{ucwords($material)}}) Stock Projek {{ucwords($category)}} {{ucwords($lokasiPart)}} Periode {{Carbon\Carbon::parse($firstRange)->isoFormat('LL');}} - {{Carbon\Carbon::parse($secondRange)->isoFormat('LL');}} </strong>
                    @elseif($material == 'rongsokan')
                        <strong>Laporan Material {{ucwords($material)}} {{ucwords($category)}} {{ucwords($lokasiPart)}} Periode {{Carbon\Carbon::parse($firstRange)->isoFormat('LL');}} - {{Carbon\Carbon::parse($secondRange)->isoFormat('LL');}} </strong>
                    @else
                        <strong>Laporan Material Bukan Persediaan( Direct {{ucwords($material)}} ) {{ucwords($category)}} {{ucwords($lokasiPart)}} Periode {{Carbon\Carbon::parse($firstRange)->isoFormat('LL');}} - {{Carbon\Carbon::parse($secondRange)->isoFormat('LL');}} </strong>
                    @endif
                </th>
            </tr>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Nama Part</th>
                <th scope="col">Deskripsi</th>
                <th scope="col">Size</th>
                <th scope="col">Satuan</th>
                <th scope="col">Jumlah Awal</th>
                <th scope="col">Jumlah Akhir</th>
                <th scope="col" colspan="4">Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($list as $data)
            <tr>
                <td scope="row">{{$loop->iteration}}</td>
                <td>{{$data->namaPart}}</td>
                <td>{{$data->descPart}}</td>
                <td>{{$data->size}}</td>
                <td>{{$data->satuanPart}}</td>
                <td>{{$data->stockAwal}}</td>
                <td>{{$data->stockAkhir}}</td>
                <td colspan="4">{{$data->keterangan}}</td>
            </tr>
            @empty
            <td colspan="8" class="text-center">
                Tidak ada Data
            </td>
            @endforelse
        </tbody>
    </table>
</div>