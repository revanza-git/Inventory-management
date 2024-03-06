<?php

namespace App\Http\Controllers;

use App\Models\FlowOutPart;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PhotoController extends Controller
{
    public function showPhoto($id)
    {
        $queryFindRecords = FlowOutPart::findOrFail($id);

        $idPart = $queryFindRecords->idPart;
        $queryFindPart = Part::find($idPart);
        $nama = $queryFindPart->namaPart;
        $category = ucwords($queryFindPart->kategoriPart);
        $link = 'FlowOutDetails.flowOut-detail';

        return view($link, ['data' => $queryFindRecords, 'category' => $category,'nama' => $nama]);
    }
}
