<?php


namespace App\Http\Controllers;

use App\Models\FlowInPart;
use App\Models\HistoryIn;
use App\Models\Part;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;
use Carbon\Carbon; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FlowInPartController extends Controller
{   
    // TODO: SUDAH EFISIEN
    public function createDataPlusStock($id)
    {   $findCategoryPart = Part::find($id);
        $categoryPart= $findCategoryPart->kategoriPart;
        $namaPart = $findCategoryPart->namaPart;
        // dd($categoryPart);
        $link = 'PlusStockPages.part-plus-stock';
        return view($link, ['dataId' => $id , 
        'category'=>$categoryPart , 'namaPart'=>$namaPart]);
    }

    public function storeDataPlusStock(Request $request,$id)
    {   
        $attributePart = Part::findOrFail($id);
        
        $this->validate($request, [
            'nameRequester'=>'required|string',
            'departmentRequester' => 'required|string',
            'noPart'=>'required|string',
            'dtStockPartIn' => 'required|date',
            'qtyStockPartIn' => 'required|numeric|min:1',
            'priceStockPartIn' => 'required|numeric|min:4',
            'yearStockPartIn' => 'required|numeric|min:4',
            'filePhotoPartIn' => 'mimes:jpg,png,pdf',
            'filePO' => 'mimes:pdf',
            'fileBAST' => 'mimes:pdf',
            'needsStockPartIn' => 'nullable|string',
            'notesPartIn'=> 'nullable|string',
            'status'=>'nullable'
        ]);

        $data = new FlowInPart();
        $filePhotoName = NULL;
        $filePOName = NULL;
        $fileBASTName = NULL;
        // ATRIBUT DATA
        $noPart = $request->noPart;
        $yearStockPartIn = $request->yearStockPartIn;
        $namePart = $attributePart->namaPart;
        $time = date("Y-m-d_H_i_s");

        //   UPLOAD FILE FOTO (ATRIBUT)
        if ($request->hasFile('filePhotoPartIn')) {
        $filePhoto = $request->file('filePhotoPartIn');;
        $extension = $filePhoto->getClientOriginalExtension();

        $filePhotoName = 'FotoIn' . '_' . $noPart . '_' . $namePart . '(' . $yearStockPartIn . ')' . $time . '.' . $extension;
        
        $filePhoto->storeAs('data', $filePhotoName);
        }


        //UPLOAD FILE PO
        if ($request->hasFile('filePO')) {
        $filePO = $request->file('filePO');;
        $extension = $filePO->getClientOriginalExtension();

        $filePOName = 'PO' . '_' . $noPart . '_' . $namePart . '(' . $yearStockPartIn . ')' . $time . '.' . $extension;

        $filePO->storeAs('data', $filePOName);
        }

        // UPLOAD FILE BAST
        if ($request->hasFile('fileBAST')) {
        $fileBAST = $request->file('fileBAST');;
        $extension = $fileBAST->getClientOriginalExtension();

        $fileBASTName = 'BAST' . '_' . $noPart . '_' . $namePart . '(' . $yearStockPartIn . ')' . $time . '.' . $extension;

        $fileBAST->storeAs('data', $fileBASTName);
        }


        // FIELD LAINNYA
        $data->nameRequester = $request->nameRequester;
        $data->departmentRequester = $request->departmentRequester;
        $data->noPart = $request->noPart;
        $data->status = $request->status;
        $data->dtStockPartIn = $request->dtStockPartIn;
        $data->qtyStockPartIn = $request->qtyStockPartIn;
        $data->priceStockPartIn = $request->priceStockPartIn;
        $data->yearStockPartIn = $request->yearStockPartIn;
        $data->needsStockPartIn = $request->needsStockPartIn;
        $data->notesPartIn = $request->notesPartIn;

        $data->filePhotoPartIn = $filePhotoName;
        $data->filePO = $filePOName;
        $data->fileBast = $fileBASTName;
        $data->firstApprovalPartIn = "Waiting For Approval";
        $data->secondApprovalPartIn = "Waiting For Approval";
        $data->thirdApprovalPartIn = "Waiting For Approval";
        $data->thirdApprovalDocsPartIn ="Waiting For Approval";
        $data->fourthApprovalPartIn = "Waiting For Approval";

        $data->signatureUser = Auth::user()->signature;

        $data->idPart = $id;
        $checkSucces = $data->save();
        if ($checkSucces) {
            Session::flash('status', 'success');
            Session::flash('message', 'Berhasil merekam stock In');
        }
        $id = $attributePart->idPart;
        $categoryPart = $attributePart->kategoriPart;

        // // HISTORY IN 
        // $currTime = Carbon::now()->format('d, M Y [H:i:s]');
        // $history = new HistoryIn();
        // $history->status ="Waiting For Approval";
        // $history->timeStatus = $currTime;
        // $history->reason = 'Pengajuan Barang';
        // $history->name = 'Belum Ada PIC';


        // REDIRECT
        return redirect()->to($categoryPart.'-detail/' . $id);
    }

    public function edit($id)
    {
        $part = FlowInPart::findOrFail($id);
        $findIdPart = $part->idPart;
        $attributePart = Part::find($findIdPart);
        $category = ucwords($attributePart->kategoriPart);
        $linkCategory = 'flowIn-edit';
        return view('EditFlowInDataForm.' . $linkCategory, ['data' => $part,
        'category'=>$category]);
    }
    public function update(Request $request, $id){
        $updateDataFlowInPart = FlowInPart::findOrFail($id);
        $this->validate($request, [
            'noFtb'=> 'nullable',
            'noPart' => 'required|string',
            'status'=>'nullable',
            'dtStockPartIn' => 'required|date',
            'qtyStockPartIn' => 'required|numeric|min:1',
            'priceStockPartIn' => 'required|numeric|min:4',
            'yearStockPartIn' => 'required|numeric|min:4',
            'filePhotoPartIn' => 'mimes:jpg,png,pdf',
            'filePO' => 'mimes:pdf',
            'fileBAST' => 'mimes:pdf',
            'needsStockPartIn' => 'nullable|string',
            'notesPartIn' => 'nullable|string'
        ]);
        $idPart = $updateDataFlowInPart->idPart;
        $part = Part::find($idPart);
        // ATRIBUT
        $noPart = $request->noPart;
        $yearIn = $request->yearStockPartIn;
        $namePart = $part->namaPart;
        $time = date("Y-m-d_H_i_s");
        // Ubah File Foto
        if ($request->hasFile('filePhotoPartIn')) {
            $path = 'data/' . $updateDataFlowInPart->filePhotoPartIn;
            if (File::exists($path)) {
                File::delete($path);
            }
            $file = $request->file('filePhotoPartIn');;
            $extension = $file->getClientOriginalExtension();
            

            $filename = 'FotoIn_Update(' . $time . ')' . '_' . $noPart . '_' . $namePart .
                '(' . $yearIn . ').' . $extension;

            $file->storeAs('data', $filename);
            $updateDataFlowInPart->filePhotoPartIn = $filename;
        }
        // Ubah File PO
        if ($request->hasFile('filePO')) {
            $path = 'data/' . $updateDataFlowInPart->filePO;
            if (File::exists($path)) {
                File::delete($path);
            }
            $file = $request->file('filePO');;
            $extension = $file->getClientOriginalExtension();
           
            

            $filename = 'PO_Update(' . $time . ')' . '_' . $noPart . '_' . $namePart .
                '(' . $yearIn . ').' . $extension;

            $file->storeAs('data', $filename);
            $updateDataFlowInPart->filePO = $filename;
        }

        // Ubah File BAST
        if ($request->hasFile('fileBAST')) {
            $path = 'data/' . $updateDataFlowInPart->fileBAST;
            if (File::exists($path)) {
                File::delete($path);
            }
            $file = $request->file('fileBAST');;
            $extension = $file->getClientOriginalExtension();
            

            $filename = 'BAST_Update(' . $time . ')' . '_' . $noPart . '_' . $namePart.
                '(' .  $yearIn . ').' . $extension;

            $file->storeAs('data', $filename);
            $updateDataFlowInPart->fileBAST = $filename;
        }

        $updateDataFlowInPart->noPart = $request->noPart;
        $updateDataFlowInPart->status = $request->status;
        $updateDataFlowInPart->dtStockPartIn = $request->dtStockPartIn;
        $updateDataFlowInPart->qtyStockPartIn = $request->qtyStockPartIn;
        $updateDataFlowInPart->priceStockPartIn = $request->priceStockPartIn;
        $updateDataFlowInPart->yearStockPartIn = $request->yearStockPartIn;
        $updateDataFlowInPart->needsStockPartIn = $request->needsStockPartIn;
        $updateDataFlowInPart->notesPartIn = $request->notesPartIn;
        $updateDataFlowInPart->noFtb = $request->noFtb;

        $currTime =Carbon::now()->format('d, M Y [H:i:s]');
        if($updateDataFlowInPart->firstApprovalPartIn == 'Revision'){
            $updateDataFlowInPart->firstApprovalPartIn = 'Updated By User';
            $updateDataFlowInPart->timefirstApprovalPartIn = $currTime;

            // HISTORY_IN
            $history = new HistoryIn();
            $history->status = "Dokumen di update Requester";
            $history->timeStatus = $currTime;
            $history->name = auth()->user()->name;
            $history->id_flowInPart = $id;
            $history->save();

        }

        if ($updateDataFlowInPart->secondApprovalPartIn == 'Revision') {
            $updateDataFlowInPart->secondApprovalPartIn = 'Updated By User';
            $updateDataFlowInPart->timesecondApprovalPartIn = $currTime;


            // HISTORY_IN
            $history = new HistoryIn();
            $history->status = "Pemeriksaan fisik di update Requester";
            $history->timeStatus = $currTime;
            $history->name = auth()->user()->name;
            $history->id_flowInPart = $id;
            $history->save();
        }

        $checkSucces = $updateDataFlowInPart->save();
        $category = $part->kategoriPart;
        if ($checkSucces) {
            Session::flash('statusUpdateElectrical', 'success');
            Session::flash('message', 'Berhasil mengedit data Flow In '.ucwords($category));
        }

        
        $link = $category . '-detail/' . $idPart;
        return redirect()->to($link);
    }

    public function showDetail($id){
        $queryFindRecords = FlowInPart::findOrFail($id);

        $idPart = $queryFindRecords->idPart;
        $queryFindPart = Part::find($idPart);
        $nama = $queryFindPart->namaPart;
        $category = ucwords($queryFindPart->kategoriPart);
        $link = 'FlowInDetails.flowIn-detail';

        return view($link, ['data' => $queryFindRecords ,'nama'=>$nama ,'category' => $category]);
    }

    // public function updateFisikIn($id){ 
    //     $data = FlowInPart::find($id);
    //     $data->secondApprovalPartIn = 'Updated By User';
    //     $data->timesecondApprovalPartIn = Carbon::now()->format('d, M Y [H:i:s]');
    //     $data->save();
    //     return redirect()->back()->with('success', 'Sukses Update data Fisik');   
    // }

}
