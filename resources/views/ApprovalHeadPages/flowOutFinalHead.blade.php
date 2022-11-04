@extends('layouts.sidebar') 
@section('content')
@if (session()->has('success'))
<div class="alert greenAdd" role="alert" id="box">
    <div>{{session('success')}}</div>
</div>
@endif
<h1>Pending Formulir Keluar Barang</h1>
<hr class="bg-dark border-5 border-top border-dark rule">
<div class="mt-4">
    
    <div class="table-responsive-sm mt-4">
        <table id="myTable" class="table table-bordered table-hover mt-2 table-striped">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col" class="text-center">Form</th>
                    <th scope="col" class="text-center">Detail</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($dataset as $data)
                <tr>
                    <td scope="row">{{$loop->iteration}}</td>
                    <td>
                        Form ({{$data->noFkb}}) dengan pengaju {{$data->nameRequester}}
                            ({{$data->departmentRequester}})
                    </td>
                    <td>
                        <form action="/detailflowOutFinalHead" method="post">
                            @csrf
                            <input type="hidden" name="noFkb" value="{{$data->noFkb}}" >
                            <input type="hidden" name="name" value="{{$data->nameRequester}}" >
                            <input type="hidden" name="department" 
                            value="{{$data->departmentRequester}}" >
                            <div class="mb-3">
                                <button class="btn btn-sm blueDetail" type="submit">Detail</button>
                            </div>
                        </form>
                    </td>
                @empty
                <td colspan="8" class="text-center">
                   Tidak ada Data 
                </td>
                @endforelse
                </tr>
            </tbody>
        </table>
    </div>
</div>

@endsection