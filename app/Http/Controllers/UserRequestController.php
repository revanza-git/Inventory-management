<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\FlowInPart;
use App\Models\HistoryIn;
use App\Models\HistoryOut;

class UserRequestController extends Controller
{
    public function index(){

        $name = Auth::user()->name;

        if (Auth::user()->departement == 'reliability') {
            $query =    DB::table('flow_in_part')
                        ->join('part', 'flow_in_part.idPart', '=', 'part.idPart')
                        ->select(
                            'flow_in_part.dtStockPartIn',
                            'flow_in_part.nameRequester',
                            'flow_in_part.departmentRequester',
                            'part.lokasiPart',
                            'part.kategoriMaterial'
                        )
                        ->where(function ($query) {
                            $query->where('part.kategoriPart', '=', 'electrical')
                                ->orWhere('part.kategoriPart', '=', 'instrument')
                                ->orWhere('part.kategoriPart', '=', 'mechanical')
                                ->orWhere('part.kategoriPart', '=', 'provision')
                                ->orWhere('part.kategoriPart', '=', 'emergency')
                                ->orWhere('part.kategoriPart', '=', 'reliability')
                                ->orWhere('part.kategoriPart', '=', 'scrap');
                        })
                        ->whereNull('flow_in_part.noFtb')
                        ->where('flow_in_part.fourthApprovalPartIn','!=', 'Approved')
                        ->where('nameRequester','=',$name)
                        ->orderBy('flow_in_part.dtStockPartIn', 'desc')
                        ->distinct()
                        ->get();

            $queryOut = DB::table('flow_out_part')
                        ->join('part', 'flow_out_part.idPart', '=', 'part.idPart')
                        ->select(
                            'flow_out_part.dtStockPartOut',
                            'flow_out_part.nameRequester',
                            'flow_out_part.departmentRequester',
                            'part.lokasiPart',
                            'part.kategoriMaterial'
                        )
                        ->where(function ($query) {
                            $query->where('part.kategoriPart', '=', 'electrical')
                                ->orWhere('part.kategoriPart', '=', 'instrument')
                                ->orWhere('part.kategoriPart', '=', 'mechanical')
                                ->orWhere('part.kategoriPart', '=', 'provision')
                                ->orWhere('part.kategoriPart', '=', 'emergency')
                                ->orWhere('part.kategoriPart', '=', 'reliability')
                                ->orWhere('part.kategoriPart', '=', 'scrap');
                        })
                        ->whereNull('flow_out_part.noFkb')
                        ->where( 'flow_out_part.fourthApprovalPartOut', '!=', 'Approved')
                        ->where('nameRequester', '=', $name)
                        ->orderBy('flow_out_part.dtStockPartOut', 'desc')
                        ->distinct()
                        ->get();    

        }
        if (Auth::user()->departement == 'layum') {
            $query = DB::table('flow_in_part')
                    ->join('part', 'flow_in_part.idPart', '=', 'part.idPart')
                    ->select(
                        'flow_in_part.dtStockPartIn',
                        'flow_in_part.nameRequester',
                        'flow_in_part.departmentRequester',
                        'part.lokasiPart',
                        'part.kategoriMaterial'
                    )
                    ->where(function ($query) {
                        $query->where('part.kategoriPart', '=', 'tiyum')
                            ->orWhere('part.kategoriPart', '=', 'scrayum');
                    })
                    ->where('nameRequester', '=', $name)
                    ->whereNull('flow_in_part.noFtb')
                    ->where('flow_in_part.fourthApprovalPartIn', '!=', 'Approved')
                    ->orderBy('flow_in_part.dtStockPartIn', 'desc')
                    ->distinct()
                    ->get();

            $queryOut = DB::table('flow_out_part')
                        ->join('part', 'flow_out_part.idPart', '=', 'part.idPart')
                        ->select(
                            'flow_out_part.dtStockPartOut',
                            'flow_out_part.nameRequester',
                            'flow_out_part.departmentRequester',
                            'part.lokasiPart',
                            'part.kategoriMaterial'
                        )
                        ->where(function ($query) {
                            $query->where('part.kategoriPart', '=', 'tiyum')
                                ->orWhere('part.kategoriPart', '=', 'scrayum');
                        })
                        ->whereNull('flow_out_part.noFkb')
                        ->where('flow_out_part.fourthApprovalPartOut', '!=', 'Approved')
                        ->where('nameRequester', '=', $name)
                        ->orderBy('flow_out_part.dtStockPartOut', 'desc')
                        ->distinct()
                        ->get();
                
        }
        if (Auth::user()->departement == 'technology') {
            $query = DB::table('flow_in_part')
                    ->join('part', 'flow_in_part.idPart', '=', 'part.idPart')
                    ->select(
                        'flow_in_part.dtStockPartIn',
                        'flow_in_part.nameRequester',
                        'flow_in_part.departmentRequester',
                        'part.lokasiPart',
                        'part.kategoriMaterial'
                    )
                    ->where('part.kategoriPart', '=', 'technology')
                    ->whereNull('flow_in_part.noFtb')
                    ->where('flow_in_part.fourthApprovalPartIn', '!=', 'Approved')
                    ->where('nameRequester', '=', $name)
                    ->orderBy('flow_in_part.dtStockPartIn', 'desc')
                    ->distinct()
                    ->get();

            $queryOut = DB::table('flow_out_part')
                    ->join('part', 'flow_out_part.idPart', '=', 'part.idPart')
                    ->select(
                        'flow_out_part.dtStockPartOut',
                        'flow_out_part.nameRequester',
                        'flow_out_part.departmentRequester',
                        'part.lokasiPart',
                        'part.kategoriMaterial'
                    )
                        ->whereNull('flow_out_part.noFkb')
                        ->where('part.kategoriPart', '=', 'technology')
                        ->where('nameRequester', '=', $name)
                        ->where('flow_out_part.fourthApprovalPartOut', '!=', 'Approved')
                        ->orderBy('flow_out_part.dtStockPartOut', 'desc')
                        ->distinct()
                        ->get(); 
        }
        if (Auth::user()->departement == 'sekper') {
            $query = DB::table('flow_in_part')
                ->join('part', 'flow_in_part.idPart', '=', 'part.idPart')
                ->select(
                    'flow_in_part.dtStockPartIn',
                    'flow_in_part.nameRequester',
                    'flow_in_part.departmentRequester',
                    'part.lokasiPart',
                    'part.kategoriMaterial'
                )
                ->whereNull('flow_in_part.noFtb')
                ->where('flow_in_part.fourthApprovalPartIn', '!=', 'Approved')
                ->where('part.kategoriPart', '=', 'sekper')
                ->where('nameRequester', '=', $name)
                ->orderBy('flow_in_part.dtStockPartIn', 'desc')
                ->distinct()
                ->get();

            $queryOut = DB::table('flow_out_part')
            ->join('part', 'flow_out_part.idPart', '=', 'part.idPart')
                ->select(
                    'flow_out_part.dtStockPartOut',
                    'flow_out_part.nameRequester',
                    'flow_out_part.departmentRequester',
                    'part.lokasiPart',
                    'part.kategoriMaterial'
                )
                ->whereNull('flow_out_part.noFkb')
                ->where('flow_out_part.fourthApprovalPartOut', '!=', 'Approved')
                ->where('part.kategoriPart', '=', 'sekper')
                ->where('nameRequester', '=', $name)
                ->orderBy('flow_out_part.dtStockPartOut', 'desc')
                ->distinct()
                ->get();
        }

        return view('UserRequestPages.userRequest', ['list'=>$query,'listOut'=>$queryOut]);
    }

    public function showFormIn($date, $name, $lokasi, $department,$material){
        // dd($material);
        $query = DB::table('flow_in_part')
        ->join('part', 'flow_in_part.idPart', '=', 'part.idPart')
        ->select(
            'flow_in_part.id_flowInPart',
            'flow_in_part.noPart',
            'part.namaPart',
            'part.size',
            'part.kategoriPart',
            'flow_in_part.qtyStockPartIn',
            'part.satuanPart',
            'flow_in_part.firstApprovalPartIn',
            'flow_in_part.secondApprovalPartIn',
            'flow_in_part.priceStockPartIn',
            'flow_in_part.needsStockPartIn',
            'flow_in_part.nameRequester',
            'flow_in_part.filePhotoPartIn',
            'flow_in_part.filePO',
            'flow_in_part.fileBAST'
        )
        ->whereNull('flow_in_part.noFtb')
        ->where('flow_in_part.dtStockPartIn', '=', $date)
        ->where('flow_in_part.nameRequester', '=', $name)
        ->where('flow_in_part.departmentRequester', '=', $department)
        ->where('part.lokasiPart', '=', $lokasi)
        ->where('part.kategoriMaterial', '=', $material)
        ->get();
        return view ('UserRequestPages.showFormIn',['list'=>$query,'date' => $date,'name'=>$name,'lokasi'=>$lokasi, 'department'=>$department]);
    }

    public function showFormOut($date, $name, $lokasi, $department,$material)
    {
        $query = DB::table('flow_out_part')
        ->join('part', 'flow_out_part.idPart', '=', 'part.idPart')
        ->select(
            'flow_out_part.id_flowOutPart',
            'flow_out_part.noPart',
            'part.namaPart',
            'part.size',
            'part.kategoriPart',
            'flow_out_part.qtyStockPartOut',
            'part.satuanPart',
            'flow_out_part.firstApprovalPartOut',
            'flow_out_part.secondApprovalPartOut',
            'flow_out_part.priceStockPartOut',
            'flow_out_part.needsStockPartOut',
            'flow_out_part.nameRequester',
            'flow_out_part.filePhotoPartOut',
            'flow_out_part.filePO',
            'flow_out_part.fileBAST'
        )
        ->whereNull('flow_out_part.noFkb')
        ->where('flow_out_part.dtStockPartOut', '=', $date)
        ->where('flow_out_part.nameRequester', '=', $name)
        ->where('flow_out_part.departmentRequester', '=', $department)
        ->where('part.kategoriMaterial', '=', $material)
        ->where('part.lokasiPart', '=', $lokasi)
        ->get();
        return view('UserRequestPages.showFormOut', ['list' => $query, 'date' => $date, 'name' => $name, 'lokasi' => $lokasi, 'department' => $department]);
    }

    // UNTUK FTB DAN FKB
    public function indexFtb(){
        $query = DB::table('flow_in_part')
                ->select(
                    'flow_in_part.nameRequester',
                    'flow_in_part.departmentRequester',
                    'flow_in_part.noFtb'
                )
                ->whereNotNull('flow_in_part.noFtb')
                ->orderBy('flow_in_part.noFtb', 'desc')
                ->distinct('flow_in_part.noFtb')
                ->get();

        return view('ApprovedForm.ftb',['dataset'=>$query]);
    }
    public function showDetailFtb(Request $request){
        $noFtb = $request->noFtb;
        $name = $request->name;
        $department = $request->department;
        $query = DB::table('flow_in_part')
                ->join('part', 'flow_in_part.idPart', '=', 'part.idPart')
                ->select(
                    'flow_in_part.id_flowInPart',
                    'flow_in_part.dtStockPartIn',
                    'flow_in_part.noPart',
                    'part.namaPart',
                    'part.size',
                    'part.lokasiPart',
                    'part.kategoriPart',
                    'part.kategoriMaterial',
                    'flow_in_part.qtyStockPartIn',
                    'part.satuanPart',
                    'flow_in_part.priceStockPartIn',
                    'flow_in_part.needsStockPartIn',
                    'flow_in_part.firstApprovalPartIn',
                    'flow_in_part.nameFirstApprovalPartIn',
                    'flow_in_part.timeFirstApprovalPartIn',
                    'flow_in_part.secondApprovalPartIn',
                    'flow_in_part.nameSecondApprovalPartIn',
                    'flow_in_part.timeSecondApprovalPartIn',
                    'flow_in_part.filePhotoPartIn',
                    'flow_in_part.filePO',
                    'flow_in_part.fileBAST',
                    'flow_in_part.thirdApprovalPartIn',
                    'flow_in_part.nameThirdApprovalPartIn',
                    'flow_in_part.timeThirdApprovalPartIn',
                    'flow_in_part.thirdApprovalDocsPartIn',
                    'flow_in_part.nameThirdApprovalDocsPartIn',
                    'flow_in_part.timeThirdApprovalDocsPartIn',
                    'flow_in_part.fourthApprovalPartIn',
                    'flow_in_part.nameFourthApprovalPartIn',
                    'flow_in_part.timeFourthApprovalPartIn',
                    'flow_in_part.dtStockPartApprovedIn'
                )
                ->where('flow_in_part.noFtb','=',$noFtb)
                ->get(); 
        // dd($query);
        return view('ApprovedForm.detailFtb',
        ['list'=>$query,'noFtb'=>$noFtb,'name' =>$name, 'department'=>$department]);
    }

    public function exportFtb(Request $request){
        $noFtb = $request->noFtb;
        $name = $request->name;
        $department = $request->department;
        $query = DB::table('flow_in_part')
            ->join('part', 'flow_in_part.idPart', '=', 'part.idPart')
            ->select(
                'flow_in_part.id_flowInPart',
                'flow_in_part.dtStockPartIn',
                'flow_in_part.noPart',
                'part.namaPart',
                'part.size',
                'part.lokasiPart',
                'part.kategoriPart',
                'part.kategoriMaterial',
                'flow_in_part.qtyStockPartIn',
                'part.satuanPart',
                'flow_in_part.priceStockPartIn',
                'flow_in_part.needsStockPartIn',
                'flow_in_part.notesPartIn',
                'flow_in_part.yearStockPartIn',
                'flow_in_part.firstApprovalPartIn',
                'flow_in_part.nameFirstApprovalPartIn',
                'flow_in_part.timeFirstApprovalPartIn',
                'flow_in_part.secondApprovalPartIn',
                'flow_in_part.nameSecondApprovalPartIn',
                'flow_in_part.timeSecondApprovalPartIn',
                'flow_in_part.filePhotoPartIn',
                'flow_in_part.filePO',
                'flow_in_part.fileBAST',
                'flow_in_part.thirdApprovalPartIn',
                'flow_in_part.nameThirdApprovalPartIn',
                'flow_in_part.timeThirdApprovalPartIn',
                'flow_in_part.fourthApprovalPartIn',
                'flow_in_part.nameFourthApprovalPartIn',
                'flow_in_part.timeFourthApprovalPartIn',
                'flow_in_part.signatureUser',
                'flow_in_part.signatureAdmin',
                'flow_in_part.signatureHead',
                'flow_in_part.signatureMaster',
                'flow_in_part.dtStockPartApprovedIn'
            )
            ->where('flow_in_part.noFtb', '=', $noFtb)
            ->get(); 

        $data = PDF::loadview('ApprovedForm.exportFtb', ['list' =>$query,'noFtb'=>$noFtb,'name' =>$name, 'department'=>$department])->setPaper('a4', 'landscape');
        return $data->download('ftb_'.$noFtb.'.pdf');

        // return view('ApprovedForm.exportFtb', ['list' => $query, 'noFtb' => $noFtb, 'name' => $name, 'department' => $department]);        
    }

    public function exportHistoryFtb(Request $request)
    {  
        $noFtb = $request->noFtb;
        $dtStockPartIn = $request->dtStockPartIn;
        $name = $request->name;
        $department = $request->department;
        $tanggalFtb = $request->tanggalFtb;
        $history = HistoryIn::with([
            'historyIn' => fn ($query) => $query->where('noFtb', $noFtb),
        ])
        ->orderBy('id_flowInPart', 'asc')
        ->orderBy('timeStatus', 'asc')
        ->get();
     

        // return view('ApprovedForm.exportHistoryFtb', ['list' => $history, 'noFtb' => $noFtb]);

        $data = PDF::loadview('ApprovedForm.exportHistoryFtb', ['list' => $history, 'noFtb' => $noFtb,'name' =>$name, 'department'=>$department, 'dtStockPartIn' => $dtStockPartIn,
        'tanggalFtb'=>$tanggalFtb])->setPaper('a4', 'landscape');
        return $data->download('HistoriFtb_' . $noFtb . '.pdf');      
    }








    public function indexFkb(){
        $query = DB::table('flow_out_part')
        ->select(
            'flow_out_part.nameRequester',
            'flow_out_part.departmentRequester',
            'flow_out_part.noFkb'
        )
        ->whereNotNull('flow_out_part.noFkb')
        ->orderBy('flow_out_part.noFkb', 'desc')
        ->distinct('flow_out_part.noFkb')
        ->get();

        return view('ApprovedForm.fkb', ['dataset' => $query]);
    }

    public function showDetailFkb(Request $request){
        $noFkb = $request->noFkb;
        $name = $request->name;
        $department = $request->department;
        $query = DB::table('flow_out_part')
        ->join('part', 'flow_out_part.idPart', '=', 'part.idPart')
        ->select(
            'flow_out_part.id_flowOutPart',
            'flow_out_part.dtStockPartOut',
            'flow_out_part.noPart',
            'part.namaPart',
            'part.kategoriPart',
            'part.lokasiPart',
            'part.kategoriMaterial',
            'flow_out_part.qtyStockPartOut',
            'part.satuanPart',
            'flow_out_part.priceStockPartOut',
            'flow_out_part.needsStockPartOut',
            'flow_out_part.firstApprovalPartOut',
            'flow_out_part.nameFirstApprovalPartOut',
            'flow_out_part.timeFirstApprovalPartOut',
            'flow_out_part.secondApprovalPartOut',
            'flow_out_part.nameSecondApprovalPartOut',
            'flow_out_part.timeSecondApprovalPartOut',
            'flow_out_part.filePhotoPartOut',
            'flow_out_part.filePO',
            'flow_out_part.fileBAST',
            'flow_out_part.thirdApprovalPartOut',
            'flow_out_part.nameThirdApprovalPartOut',
            'flow_out_part.timeThirdApprovalPartOut',
            'flow_out_part.thirdApprovalDocsPartOut',
            'flow_out_part.nameThirdApprovalDocsPartOut',
            'flow_out_part.timeThirdApprovalDocsPartOut',
            'flow_out_part.fourthApprovalPartOut',
            'flow_out_part.nameFourthApprovalPartOut',
            'flow_out_part.timeFourthApprovalPartOut',
            'flow_out_part.dtStockPartApprovedOut',
        )
        ->where('flow_out_part.noFkb', '=', $noFkb)
        ->get();
        return view(
            'ApprovedForm.detailFkb',
            ['list' => $query, 'noFkb' => $noFkb, 'name' => $name, 'department' => $department]
        );
    }


    public function exportFkb(Request $request){
        $noFkb = $request->noFkb;
        $name = $request->name;
        $department = $request->department;
        $query = DB::table('flow_out_part')
            ->join('part', 'flow_out_part.idPart', '=', 'part.idPart')
            ->select(
                'flow_out_part.id_flowOutPart',
                'flow_out_part.dtStockPartOut',
                'flow_out_part.noPart',
                'part.namaPart',
                'part.size',
                'part.lokasiPart',
                'part.kategoriPart',
                'part.kategoriMaterial',
                'flow_out_part.qtyStockPartOut',
                'part.satuanPart',
                'flow_out_part.priceStockPartOut',
                'flow_out_part.needsStockPartOut',
                'flow_out_part.notesPartOut',
                'flow_out_part.yearStockPartOut',
                'flow_out_part.firstApprovalPartOut',
                'flow_out_part.nameFirstApprovalPartOut',
                'flow_out_part.timeFirstApprovalPartOut',
                'flow_out_part.secondApprovalPartOut',
                'flow_out_part.nameSecondApprovalPartOut',
                'flow_out_part.timeSecondApprovalPartOut',
                'flow_out_part.filePhotoPartOut',
                'flow_out_part.filePO',
                'flow_out_part.fileBAST',
                'flow_out_part.thirdApprovalPartOut',
                'flow_out_part.nameThirdApprovalPartOut',
                'flow_out_part.timeThirdApprovalPartOut',
                'flow_out_part.fourthApprovalPartOut',
                'flow_out_part.nameFourthApprovalPartOut',
                'flow_out_part.timeFourthApprovalPartOut',
                'flow_out_part.timeFourthApprovalPartOut',
                'flow_out_part.signatureUser',
                'flow_out_part.signatureHead',
                'flow_out_part.signatureMaster',
                'flow_out_part.signatureAdmin',
                'flow_out_part.dtStockPartApprovedOut'
            )
            ->where('flow_out_part.noFkb', '=', $noFkb)
            ->get();

        $data = PDF::loadview('ApprovedForm.exportFkb', ['list' => $query, 'noFkb' => $noFkb, 'name' => $name, 'department' => $department])->setPaper('a4', 'landscape');;
        return $data->download('fkb_' . $noFkb . '.pdf');
        // return view('ApprovedForm.exportFkb', ['list' => $query, 'noFkb' => $noFkb, 'name' => $name, 'department' => $department]);        
    }

    public function exportHistoryFkb(Request $request)
    {
        $noFkb = $request->noFkb;
        $dtStockPartOut = $request->dtStockPartOut;
        $name = $request->name;
        $department = $request->department;
        $tanggalFkb = $request->tanggalFkb;
        $history = HistoryOut::with([
            'historyOut' => fn ($query) => $query->where('noFkb', $noFkb),
        ])
            ->orderBy('id_flowOutPart', 'asc')
            ->orderBy('timeStatus', 'asc')
            ->get();

        // dd($history);
        // return view('ApprovedForm.exportHistoryFkb', [
        //     'list' => $history, 'noFkb' => $noFkb, 'name' => $name, 'department' => $department, 'dtStockPartOut' => $dtStockPartOut,
        //     'tanggalFkb' => $tanggalFkb
        // ]);

        $data = PDF::loadview('ApprovedForm.exportHistoryFkb', [
            'list' => $history, 'noFkb' => $noFkb, 'name' => $name, 'department' => $department, 'dtStockPartOut' => $dtStockPartOut,
            'tanggalFkb' => $tanggalFkb
        ])->setPaper('a4', 'landscape');
        return $data->download('HistoriFkb_' . $noFkb . '.pdf');
    }
}
