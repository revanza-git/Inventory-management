<div class="table-responsive-sm mt-4">
    <table id="reportTable" class="table table-bordered table-hover mt-2 table-striped">
        <thead>
            <tr>
                <th colspan="10" rowspan="4"></th>
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
                <th colspan="10" style="text-align:center;"> 
                    <strong>Laporan Rekapitulasi {{ucwords($category)}} Jaringan Periode 
                        {{Carbon\Carbon::parse($firstRange)->isoFormat('LL');}} - {{Carbon\Carbon::parse($secondRange)->isoFormat('LL');}}
                    </strong>
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
                <th scope="col">Lokasi</th>
                <th scope="col">Kategori Material</th>
                <th scope="col">Keterangan</th>
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
                <td>{{$data->lokasiPart}}</td>
                @if($data->kategoriMaterial=='stock')
                <td>Material Persediaan ({{ucwords($data->kategoriMaterial)}})</td>
                @elseif($data->kategoriMaterial=='surplus')
                <td>Material Projek ({{ucwords($data->kategoriMaterial)}})</td>
                @elseif($data->kategoriMaterial=='rongsokan')
                <td>Material ({{ucwords($data->kategoriMaterial)}})</td>
                @elseif($data->kategoriMaterial=='dead')
                <td>Material Persediaan Mati ({{ucwords($data->kategoriMaterial)}})</td>
                @elseif($data->kategoriMaterial=='charges')
                <td>Material Bukan Persediaan (Direct {{ucwords($data->kategoriMaterial)}})</td>
                @endif
                <td>{{$data->keterangan}}</td>
            </tr>
            @empty
            <td colspan="8" class="text-center">
                Tidak ada Data
            </td>
            @endforelse
        </tbody>
    </table>
</div>