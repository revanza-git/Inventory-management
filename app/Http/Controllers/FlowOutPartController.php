<?php

namespace App\Http\Controllers;

use App\Models\FlowInPart;
use App\Models\FlowOutPart;
use App\Models\HistoryOut;
use App\Models\Part;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class FlowOutPartController extends Controller
{   
   
    public function createDataMinusStock($id)
    {
        
        $findRecords  = Part::find($id);
        $namaPart = $findRecords->namaPart;
        $category = $findRecords->kategoriPart;
        $size = $findRecords->size;
        $material = $findRecords->kategoriMaterial;

        if(!is_null($size)){
            $queryAllFlowIn = DB::table('flow_in_part')
                            ->join('part','flow_in_part.idPart','=','part.idPart')
                            ->select('flow_in_part.id_flowInPart','flow_in_part.noPart',
                            'flow_in_part.priceStockPartIn',
                            'flow_in_part.yearStockPartIn')
                            ->where([
                                ['firstApprovalPartIn', '=', 'Approved'],
                                ['secondApprovalPartIn', '=', 'Approved'],
                                ['thirdApprovalPartIn', '=', 'Approved'],
                                ['fourthApprovalPartIn', '=', 'Approved']
                            ])
                            ->where('part.namaPart','=',$namaPart)
                            ->where('part.size', '=', $size)
                            ->where('part.kategoriMaterial', '=', $material)
                            ->get();
            }
            else{
                $queryAllFlowIn = DB::table('flow_in_part')
                    ->join('part', 'flow_in_part.idPart', '=', 'part.idPart')
                    ->select(
                        'flow_in_part.id_flowInPart',
                        'flow_in_part.noPart',
                        'flow_in_part.priceStockPartIn',
                        'flow_in_part.yearStockPartIn'
                    )
                    ->where([
                        ['firstApprovalPartIn', '=', 'Approved'],
                        ['secondApprovalPartIn', '=', 'Approved'],
                        ['thirdApprovalPartIn', '=', 'Approved'],
                        ['fourthApprovalPartIn', '=', 'Approved']
                    ])
                    ->where('part.namaPart', '=', $namaPart)
                    ->where('part.kategoriMaterial', '=', $material)
                    ->get();
            }
                
       

        return view('MinusStockPages.part-minus-stock', [
            'dataId' => $id,
            'dataIn' => $queryAllFlowIn,
            'category' => $category,
            'namaPart' => $namaPart
        ]);
    }
    // BUat ganti data by nomor part
    public function getData($noPart){
      
        $data = FlowInPart::where('noPart', $noPart)->get();

         return response()->json($data);
    }

    public function storeDataMinusStock(Request $request, $id)
    {
        $attributePart = Part::findOrFail($id);

        $this->validate($request, [
            'nameRequester' => 'required|string',
            'departmentRequester' => 'required|string',
            'noPart' => 'required|string',
            'dtStockPartOut' => 'required|date',
            'qtyStockPartOut' => 'required|numeric|min:1',
            'priceStockPartOut' => 'required|numeric|min:4',
            'yearStockPartOut' => 'required|numeric|min:4',
            'filePhotoPartOut' => 'mimes:jpg,png,pdf',
            'filePO' => 'mimes:pdf',
            'fileBAST' => 'mimes:pdf',
            'needsStockPartOut' => 'nullable|string',
            'notesPartIn' => 'nullable|string'
        ]);

        $data = new FlowOutPart();
        $filePhotoName = NULL;
        $filePOName = NULL;
        $fileBASTName = NULL;
        // ATRIBUT DATA
        $noPart = $request->noPart;
        $yearStockPartOut = $request->yearStockPartOut;
        $namePart = $attributePart->namaPart;
        $time = date("Y-m-d_H_i_s");

        //   UPLOAD FILE FOTO (ATRIBUT)
        if ($request->hasFile('filePhotoPartOut')) {
            $filePhoto = $request->file('filePhotoPartOut');;
            $extension = $filePhoto->getClientOriginalExtension();

            $filePhotoName = 'Foto' . '_' . $noPart . '_' . $namePart . '(' . $yearStockPartOut . ')' . $time . '.' . $extension;

            $filePhoto->storeAs('data', $filePhotoName);
        }


        //UPLOAD FILE PO
        if ($request->hasFile('filePO')) {
            $filePO = $request->file('filePO');;
            $extension = $filePO->getClientOriginalExtension();

            $filePOName = 'FileLainnya' . '_' . $noPart . '_' . $namePart . '(' . $yearStockPartOut . ')' . $time . '.' . $extension;

            $filePO->storeAs('data', $filePOName);
        }

        // UPLOAD FILE BAST
        if ($request->hasFile('fileBAST')) {
            $fileBAST = $request->file('fileBAST');;
            $extension = $fileBAST->getClientOriginalExtension();

            $fileBASTName = 'FileLainnya' . '_' . $noPart . '_' . $namePart . '(' . $yearStockPartOut. ')' . $time . '.' . $extension;

            $fileBAST->storeAs('data', $fileBASTName);
        }


        // FIELD LAINNYA
        $data->nameRequester = $request->nameRequester;
        $data->departmentRequester = $request->departmentRequester;
        $data->noPart = $request->noPart;
        $data->status = $request->status;
        $data->dtStockPartOut = $request->dtStockPartOut;
        $data->qtyStockPartOut = $request->qtyStockPartOut;
        $data->priceStockPartOut = $request->priceStockPartOut;
        $data->yearStockPartOut = $request->yearStockPartOut;
        $data->needsStockPartOut = $request->needsStockPartOut;
        $data->notesPartOut = $request->notesPartOut;

        $data->filePhotoPartOut = $filePhotoName;
        $data->filePO = $filePOName;
        $data->fileBast = $fileBASTName;
        $data->firstApprovalPartOut = "Waiting For Approval";
        $data->secondApprovalPartOut = "Waiting For Approval";
        $data->thirdApprovalPartOut = "Waiting For Approval";
        $data->thirdApprovalDocsPartOut = "Waiting For Approval";
        $data->fourthApprovalPartOut = "Waiting For Approval";

        $data->signatureUser = Auth::user()->signature;

        $data->idPart = $id;
        $checkSucces = $data->save();
        if ($checkSucces) {
            Session::flash('status', 'success');
            Session::flash('message', 'Berhasil merekam stock Out');
        }
        $id = $attributePart->idPart;
        $categoryPart = $attributePart->kategoriPart;

        // REDIRECT
        return redirect()->to($categoryPart . '-detail/' . $id);
    }


    public function edit($id)
    {
        $part = FlowOutPart::findOrFail($id);
        $findIdPart = $part->idPart;
        $attributePart = Part::find($findIdPart);
        $category = ucwords($attributePart->kategoriPart);
        $link = 'EditFlowOutDataForm.' . 'flowOut-edit';
        return view($link , [
            'data' => $part,
            'category' => $category
        ]);
    }

    public function update(Request $request, $id)
    {
        $updateDataFlowOutPart = FlowOutPart::findOrFail($id);
        $idPart = $updateDataFlowOutPart->idPart;
        $part = Part::find($idPart);
        // ATRIBUT
        $noPart = $request->noPart;
        $yearOut = $request->yearStockPartOut;
        $namePart = $part->namaPart;
        $time = date("Y-m-d_H_i_s");

        $this->validate($request, [
            'noFkb' => 'nullable',
            'noPart' => 'required|string',
            'dtStockPartOut' => 'required|date',
            'qtyStockPartOut' => 'required|numeric|min:1',
            'priceStockPartOut' => 'required|numeric|min:4',
            'yearStockPartOut' => 'required|numeric|min:4',
            'filePhotoPartOut' => 'mimes:jpg,png,pdf',
            'filePO' => 'mimes:pdf',
            'fileBAST' => 'mimes:pdf',
            'needsStockPartOut' => 'nullable|string',
            'notesPartIn' => 'nullable|string'
        ]);

        // Ubah File Foto
        if ($request->hasFile('filePhotoPartOut')) {
            $path = 'data/' . $updateDataFlowOutPart->filePhotoPartOut;
            if (File::exists($path)) {
                File::delete($path);
            }
            $file = $request->file('filePhotoPartOut');;
            $extension = $file->getClientOriginalExtension();


            $filename = 'FotoOut_Update(' . $time . ')' . '_' . $noPart . '_' . $namePart .
                '(' . $yearOut . ').' . $extension;

            $file->storeAs('data', $filename);
            $updateDataFlowOutPart->filePhotoPartOut = $filename;
        }
        // Ubah File PO
        if ($request->hasFile('filePO')) {
            $path = 'data/' . $updateDataFlowOutPart->filePO;
            if (File::exists($path)) {
                File::delete($path);
            }
            $file = $request->file('filePO');;
            $extension = $file->getClientOriginalExtension();



            $filename = 'FileLainOut_Update(' . $time . ')' . '_' . $noPart . '_' . $namePart .
                '(' . $yearOut . ').' . $extension;

            $file->storeAs('data', $filename);
            $updateDataFlowOutPart->filePO = $filename;
        }

        // Ubah File BAST
        if ($request->hasFile('fileBAST')) {
            $path = 'data/' . $updateDataFlowOutPart->fileBAST;
            if (File::exists($path)) {
                File::delete($path);
            }
            $file = $request->file('fileBAST');;
            $extension = $file->getClientOriginalExtension();


            $filename = 'FileLainOut_Update(' . $time . ')' . '_' . $noPart . '_' . $namePart .
                '(' .  $yearOut . ').' . $extension;

            $file->storeAs('data', $filename);
            $updateDataFlowOutPart->fileBAST = $filename;
        }

        $updateDataFlowOutPart->noPart = $request->noPart;
        $updateDataFlowOutPart->dtStockPartOut = $request->dtStockPartOut;
        $updateDataFlowOutPart->qtyStockPartOut = $request->qtyStockPartOut;
        $updateDataFlowOutPart->priceStockPartOut = $request->priceStockPartOut;
        $updateDataFlowOutPart->yearStockPartOut = $request->yearStockPartOut;
        $updateDataFlowOutPart->needsStockPartOut = $request->needsStockPartOut;
        $updateDataFlowOutPart->notesPartOut = $request->notesPartOut;
        $updateDataFlowOutPart->noFkb = $request->noFkb;

        // TRIGGER
        $currTime = Carbon::now()->format('d, M Y [H:i:s]');
        if ($updateDataFlowOutPart->firstApprovalPartOut == 'Revision') {
            $updateDataFlowOutPart->firstApprovalPartOut = 'Updated By User';
            $updateDataFlowOutPart->timefirstApprovalPartOut = $currTime;

            // HISTORY_Out
            $history = new HistoryOut();
            $history->status = "Dokumen di update Requester";
            $history->timeStatus = $currTime;
            $history->name = auth()->user()->name;
            $history->id_flowOutPart = $id;
            $history->save();
        }
        if ($updateDataFlowOutPart->secondApprovalPartOut == 'Revision') {
            $updateDataFlowOutPart->secondApprovalPartOut = 'Updated By User';
            $updateDataFlowOutPart->timesecondApprovalPartOut = $currTime;

            // HISTORY_Out
            $history = new HistoryOut();
            $history->status = "Pemeriksaan fisik di update Requester";
            $history->timeStatus = $currTime;
            $history->name = auth()->user()->name;
            $history->id_flowOutPart = $id;
            $history->save();
        }
        
        $checkSucces = $updateDataFlowOutPart->save();

        $category = $part->kategoriPart;
        if ($checkSucces) {
            Session::flash('statusUpdateElectrical', 'success');
            Session::flash('message', 'Berhasil mengedit data Flow Out '.ucwords($category));
        }

        
        $link = $category . '-detail/' . $idPart;
        return redirect()->to($link);
    }

    public function showDetail($id)
    {
        $queryFindRecords = FlowOutPart::findOrFail($id);

        $idPart = $queryFindRecords->idPart;
        $queryFindPart = Part::find($idPart);
        $nama = $queryFindPart->namaPart;
        $category = ucwords($queryFindPart->kategoriPart);
        $link = 'FlowOutDetails.flowOut-detail';

        return view($link, ['data' => $queryFindRecords, 'category' => $category,'nama' => $nama]);
    }

    public function updateFisikOut($id)
    {
        $data = FlowOutPart::find($id);
        $data->secondApprovalPartOut = 'Updated By User';
        $data->timesecondApprovalPartOut = Carbon::now()->format('d, M Y [H:i:s]');
        $data->save();
        return redirect()->back()->with('success', 'Sukses Update data Fisik');
    }

}
