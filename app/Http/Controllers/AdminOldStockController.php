<?php

namespace App\Http\Controllers;

use App\Models\Part;
use App\Models\FlowInPart;
use App\Models\FlowOutPart;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class AdminOldStockController extends Controller
{
    public function createPlusOldDataStock($id){
        $findCategoryPart = Part::find($id);
        $categoryPart = $findCategoryPart->kategoriPart;
        $namaPart = $findCategoryPart->namaPart;
        // dd($findCategoryPart);
        $link = 'OldDataPages.PlusPartPages.plusOldPart';
        return view($link, [
            'dataId' => $id,
            'category' => $categoryPart, 'namaPart' => $namaPart
        ]);
    }

    public function storePlusOldDataStock(Request $request, $id){

        $attributePart = Part::findOrFail($id);
      
        $this->validate($request,[
            'nameRequester' => 'required|string',
            'departmentRequester' => 'required|string',
            'noPart' => 'required|string',
            'noFtb'=> 'required|string',
            'dtStockPartIn' => 'required|date',
            'dtStockPartApprovedIn' => 'required|date',
            'qtyStockPartIn' => 'required|numeric|min:1',
            'priceStockPartIn' => 'required|numeric|min:4',
            'yearStockPartIn' => 'required|numeric|min:4',
            'filePhotoPartIn' => 'mimes:jpg,png,pdf',
            'filePO' => 'mimes:pdf',
            'fileBAST' => 'mimes:pdf',
            'needsStockPartIn' => 'nullable|string',
            'notesPartIn' => 'nullable|string',
            'status' => 'required',
            'signatureUser' => 'required|mimes:png',
            'signatureHead' => 'required|mimes:png',
            'nameHead'=>'required|string',
            'signatureMaster' => 'required|mimes:png',
            'nameHeadProc' => 'required|string',
        ]);
        $data = new FlowInPart();
        $filePhotoName = NULL;
        $filePOName = NULL;
        $fileBASTName = NULL;
        $signatureUserFileName =NULL;
        $signatureAdminFileName = NULL;
        $signatureHeadFileName = NULL;
        $signatureMasterFileName = NULL;
        // ATRIBUT DATA
        $noPart = $request->noPart;
        $yearStockPartIn = $request->yearStockPartIn;
        $namePart = $attributePart->namaPart;
        $time = date("Y-m-d_H_i_s");


        if ($request->hasFile('filePhotoPartIn')) {
            $filePhotoPartInFile = $request->file('filePhotoPartIn');;
            $extension = $filePhotoPartInFile->getClientOriginalExtension();
            $filePhotoName =
            'FotoIn_(LAMPAU)' . '_' . $noPart . '_' . $namePart . '(' . $yearStockPartIn . ')' . $time . '.' . $extension;
            $filePhotoPartInFile->storeAs('data', $filePhotoName);
        }
        if ($request->hasFile('filePO')) {
            $filePOFile = $request->file('filePO');;
            $extension = $filePOFile->getClientOriginalExtension();
            $filePOName =
            'PO_(LAMPAU)' . '_' . $noPart . '_' . $namePart . '(' . $yearStockPartIn . ')' . $time . '.' . $extension;
            $filePOFile->storeAs('data', $filePOName);
        }
        if ($request->hasFile('fileBAST')) {
            $fileBASTFile = $request->file('fileBAST');;
            $extension = $fileBASTFile->getClientOriginalExtension();
            $fileBASTName = 'BAST_(LAMPAU)' . '_' . $noPart . '_' . $namePart . '(' . $yearStockPartIn . ')' . $time . '.' . $extension;
            $fileBASTFile->storeAs('data', $fileBASTName);
        }
        if ($request->hasFile('signatureUser')) {
            $signatureUserFile = $request->file('signatureUser');;
            $extension = $signatureUserFile->getClientOriginalExtension();
            $user = $request->nameRequester;
            $signatureUserFileName = 'signatureUser' . '_' . $user . '.' . $extension;
            $signatureUserFile->storeAs('data', $signatureUserFileName);
        }
        if ($request->hasFile('signatureHead')) {
            $signatureHeadFile = $request->file('signatureHead');;
            $extension = $signatureHeadFile->getClientOriginalExtension();
            $user = $request->nameHead;
            $signatureHeadFileName = 'signatureHead' . '_' . $user . '.' . $extension;
            $signatureHeadFile->storeAs('data', $signatureHeadFileName);
        }
        if ($request->hasFile('signatureMaster')) {
            $signatureMasterFile = $request->file('signatureMaster');;
            $extension = $signatureMasterFile->getClientOriginalExtension();
            $user =$request->nameHeadProc;
            $signatureMasterFileName = 'signatureMaster' . '_' . $user . '.' . $extension;
            $signatureMasterFile->storeAs('data', $signatureMasterFileName);
        }

        // FIELD LAINNYA
        $data->dtStockPartApprovedIn = $request->dtStockPartApprovedIn;
        $data->noFtb = $request->noFtb;
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
        $data->signatureUser = $signatureUserFileName;
        $data->signatureAdmin = auth()->user()->signature;
        $data->signatureHead = $signatureHeadFileName;
        $data->signatureMaster = $signatureMasterFileName;
        $data->firstApprovalPartIn = "Approved";
        $data->nameFirstApprovalPartIn = auth()->user()->name;
        $data->secondApprovalPartIn = "Approved";
        $data->nameSecondApprovalPartIn = auth()->user()->name;
        $data->thirdApprovalPartIn = "Approved";
        $data->nameThirdApprovalPartIn = $request->nameHead;
        $data->thirdApprovalDocsPartIn = "Approved";
        $data->nameThirdApprovalDocsPartIn = $request->nameHead;
        $data->fourthApprovalPartIn = "Approved";
        $data->nameFourthApprovalPartIn = $request->nameHeadProc;

        $data->idPart = $id;
        $checkSucces = $data->save();
        if ($checkSucces) {
            Session::flash('status', 'success');
            Session::flash('message', 'Berhasil merekam stock In');
        }
        $id = $attributePart->idPart;
        $categoryPart = $attributePart->kategoriPart;

        // REDIRECT
        return redirect()->to($categoryPart . '-detail/' . $id);
    }


    public function createMinusOldDataStock($id){
        $findCategoryPart = Part::find($id);
        $categoryPart = $findCategoryPart->kategoriPart;
        $namaPart = $findCategoryPart->namaPart;
        // dd($findCategoryPart);
        $link = 'OldDataPages.MinusPartPages.minusOldPart';
        return view($link, [
            'dataId' => $id,
            'category' => $categoryPart, 'namaPart' => $namaPart
        ]);
    }

    public function storeMinusOldDataStock(Request $request, $id){
        $attributePart = Part::findOrFail($id);
        $this->validate($request, [
            'nameRequester' => 'required|string',
            'departmentRequester' => 'required|string',
            'noPart' => 'required|string',
            'noFkb' => 'required|string',
            'dtStockPartOut' => 'required|date',
            'dtStockPartApprovedOut' => 'required|date',
            'qtyStockPartOut' => 'required|numeric|min:1',
            'priceStockPartOut' => 'required|numeric|min:4',
            'yearStockPartOut' => 'required|numeric|min:4',
            'filePhotoPartOut' => 'mimes:jpg,png,pdf',
            'filePO' => 'mimes:pdf',
            'fileBAST' => 'mimes:pdf',
            'needsStockPartOut' => 'nullable|string',
            'notesPartOut' => 'nullable|string',
            'status' => 'required',
            'signatureUser' => 'required|mimes:png',
            'signatureHead' => 'required|mimes:png',
            'nameHead' => 'required|string',
            'signatureMaster' => 'required|mimes:png',
            'nameHeadProc' => 'required|string',
        ]);

        $data = new FlowOutPart();
        $filePhotoName = NULL;
        $filePOName = NULL;
        $fileBASTName = NULL;
        $signatureUserFileName = NULL;
        $signatureAdminFileName = NULL;
        $signatureHeadFileName = NULL;
        $signatureMasterFileName = NULL;
        // ATRIBUT DATA
        $noPart = $request->noPart;
        $yearStockPartOut = $request->yearStockPartOut;
        $namePart = $attributePart->namaPart;
        $time = date("Y-m-d_H_i_s");


        if ($request->hasFile('filePhotoPartOut')) {
            $filePhotoPartOutFile = $request->file('filePhotoPartOut');;
            $extension = $filePhotoPartOutFile->getClientOriginalExtension();
            $filePhotoName =
                'FotoIn_(LAMPAU)' . '_' . $noPart . '_' . $namePart . '(' . $yearStockPartOut . ')' . $time . '.' . $extension;
            $filePhotoPartOutFile->storeAs('data', $filePhotoName);
        }
        if ($request->hasFile('filePO')) {
            $filePOFile = $request->file('filePO');;
            $extension = $filePOFile->getClientOriginalExtension();
            $filePOName =
                'PO_(LAMPAU)' . '_' . $noPart . '_' . $namePart . '(' . $yearStockPartOut . ')' . $time . '.' . $extension;
            $filePOFile->storeAs('data', $filePOName);
        }
        if ($request->hasFile('fileBAST')) {
            $fileBASTFile = $request->file('fileBAST');;
            $extension = $fileBASTFile->getClientOriginalExtension();
            $fileBASTName = 'BAST_(LAMPAU)' . '_' . $noPart . '_' . $namePart . '(' . $yearStockPartOut . ')' . $time . '.' . $extension;
            $fileBASTFile->storeAs('data', $fileBASTName);
        }
        if ($request->hasFile('signatureUser')) {
            $signatureUserFile = $request->file('signatureUser');;
            $extension = $signatureUserFile->getClientOriginalExtension();
            $user = $request->nameRequester;
            $signatureUserFileName = 'signatureUser' . '_' . $user . '.' . $extension;
            $signatureUserFile->storeAs('data', $signatureUserFileName);
        }
        if ($request->hasFile('signatureHead')) {
            $signatureHeadFile = $request->file('signatureHead');;
            $extension = $signatureHeadFile->getClientOriginalExtension();
            $user = $request->nameHead;
            $signatureHeadFileName = 'signatureHead' . '_' . $user . '.' . $extension;
            $signatureHeadFile->storeAs('data', $signatureHeadFileName);
        }
        if ($request->hasFile('signatureMaster')) {
            $signatureMasterFile = $request->file('signatureMaster');;
            $extension = $signatureMasterFile->getClientOriginalExtension();
            $user = $request->nameHeadProc;
            $signatureMasterFileName = 'signatureMaster' . '_' . $user . '.' . $extension;
            $signatureMasterFile->storeAs('data', $signatureMasterFileName);
        }

        // FIELD LAINNYA
        $data->dtStockPartApprovedOut = $request->dtStockPartApprovedOut;
        $data->noFkb = $request->noFkb;
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
        $data->signatureUser = $signatureUserFileName;
        $data->signatureAdmin = auth()->user()->signature;
        $data->signatureHead = $signatureHeadFileName;
        $data->signatureMaster = $signatureMasterFileName;
        $data->firstApprovalPartOut = "Approved";
        $data->nameFirstApprovalPartOut = auth()->user()->name;
        $data->secondApprovalPartOut = "Approved";
        $data->nameSecondApprovalPartOut = auth()->user()->name;
        $data->thirdApprovalPartOut = "Approved";
        $data->nameThirdApprovalPartOut = $request->nameHead;
        $data->thirdApprovalDocsPartOut = "Approved";
        $data->nameThirdApprovalDocsPartOut = $request->nameHead;
        $data->fourthApprovalPartOut = "Approved";
        $data->nameFourthApprovalPartOut = $request->nameHeadProc;

        $data->idPart = $id;
        $checkSucces = $data->save();
        if ($checkSucces) {
            Session::flash('status', 'success');
            Session::flash('message', 'Berhasil merekam stock In');
        }
        $id = $attributePart->idPart;
        $categoryPart = $attributePart->kategoriPart;

        // REDIRECT
        return redirect()->to($categoryPart . '-detail/' . $id);
    }
}
