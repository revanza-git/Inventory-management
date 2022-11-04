<?php

namespace App\Http\Controllers;


use App\Models\Part;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class PartController extends Controller
{
    public function createPart()
    {
        return view('CreatePartForm.add-part');
    }

    public function storeNewPart(Request $request){
    //    dd($request);
        $validatedData = $request->validate([
            'namaPart' => 'required',
            'kategoriMaterial' => 'required',
            'kategoriPart' => 'required',
            'descPart' => 'required',
            'satuanPart' => 'required',
            'lokasiPart' => 'required',
            'size'=>'nullable',
            'keterangan' => 'nullable'
        ]);
        $checkSucces = Part::create($validatedData);
        $category = $validatedData['kategoriPart'];
        // dd($checkSucces);
        if ($checkSucces) {
            Session::flash('status', 'success');
            Session::flash('message', 'Berhasil menambah data ' . $category);
        }
        return redirect('/'. $category)->with('success', 'Berhasil Menambahkan Barang Baru'); 
        // return redirect()->back()->with('success', 'Berhasil Menambahkan Barang Baru'); 
    }

    // TODO:INDEX OF CATEGORY
    public function showIndexElectrical(){
        $queryAllElectrical = 
        Part::select('idPart', 'namaPart', 'descPart', 'lokasiPart', 'kategoriPart','size','kategoriMaterial')
        ->where('kategoriPart','=','electrical')
        ->get();
        return view('electrical', ['electricalList' => $queryAllElectrical]);
    }
    public function showIndexInstrument()
    {
        $queryAllInstrument =
            Part::select('idPart', 'namaPart', 'descPart', 'lokasiPart', 'kategoriPart','size', 'kategoriMaterial')
            ->where('kategoriPart', '=', 'instrument')
            ->get();
        return view('instrument', ['instrumentList' => $queryAllInstrument]);
    }
    public function showIndexMechanical()
    {   $queryAll =
            Part::select('idPart', 'namaPart', 'descPart', 'lokasiPart', 'kategoriPart','size','kategoriMaterial')
            ->where('kategoriPart', '=', 'mechanical')
            ->get();
        return view('mechanical', ['mechanicalList' => $queryAll]);
    }
    public function showIndexProvision()
    {
        $queryAll =
            Part::select('idPart', 'namaPart', 'descPart', 'lokasiPart', 'kategoriPart','size', 'kategoriMaterial')
            ->where('kategoriPart', '=', 'provision')
            ->get();
        return view('provision', ['provisionList' => $queryAll]);
    }
    public function showIndexEmergency()
    {
        $queryAll =
            Part::select('idPart', 'namaPart', 'descPart', 'lokasiPart', 'kategoriPart','size', 'kategoriMaterial')
            ->where('kategoriPart', '=', 'emergency')
            ->get();
        return view('emergency', ['emergencyList' => $queryAll]);
    }
    public function showIndexReliability(){
        $queryAll =
            Part::select('idPart', 'namaPart', 'descPart', 'lokasiPart', 'kategoriPart','size', 'kategoriMaterial')
            ->where('kategoriPart', '=', 'reliability')
            ->get();
        return view('reliability', ['reliabilityList' => $queryAll]);
    }
    public function showIndexScrap()
    {
        $queryAll =
            Part::select('idPart', 'namaPart', 'descPart', 'lokasiPart', 'kategoriPart','size', 'kategoriMaterial')
            ->where('kategoriPart', '=', 'scrap')
            ->get();
        return view('scrap', ['scrapList' => $queryAll]);
    }

    public function showIndexTechnology(){
        $queryAll =
            Part::select('idPart', 'namaPart', 'descPart', 'lokasiPart', 'kategoriPart','size', 'kategoriMaterial')
            ->where('kategoriPart', '=', 'technology')
            ->get();
        return view('technology', ['technologyList' => $queryAll]);
    }

    public function showIndexTiyum(){
        $queryAll =
            Part::select('idPart', 'namaPart', 'descPart', 'lokasiPart', 'kategoriPart','size', 'kategoriMaterial')
            ->where('kategoriPart', '=', 'tiyum')
            ->get();
        return view('tiyum', ['tiyumList' => $queryAll]);
    }
    public function showIndexScrayum()
    {
        $queryAll =
            Part::select('idPart', 'namaPart', 'descPart', 'lokasiPart', 'kategoriPart','size', 'kategoriMaterial')
            ->where('kategoriPart', '=', 'scrayum')
            ->get();
        return view('scrayum', ['scrayumList' => $queryAll]);
    }
    public function showIndexSekper(){
        $queryAll =
            Part::select('idPart', 'namaPart', 'descPart', 'lokasiPart', 'kategoriPart','size', 'kategoriMaterial')
            ->where('kategoriPart', '=', 'sekper')
            ->get();
        return view('sekper', ['sekperList' => $queryAll]);
    }


    public function showRecords($id){
        $queryFindRecords = Part::findOrFail($id);
       
        // QUERY FLOW IN DAN FLOW OUT
        $flowInRecords = DB::table('flow_in_part')
                        ->where('idPart', $id)
                        ->orderBy('dtStockPartIn', 'desc')
                        ->get();
        $flowOutRecords = DB::table('flow_out_part')
                        ->where('idPart', $id)
                        ->orderBy('dtStockPartOut', 'desc')
                        ->get();


        $sumFlowIn = DB::table('flow_in_part')
            ->where('idPart', $id)
            ->where([
                ['firstApprovalPartIn', '=', 'Approved'],
                ['secondApprovalPartIn', '=', 'Approved'],
                ['thirdApprovalPartIn', '=', 'Approved'],
                ['fourthApprovalPartIn', '=', 'Approved']
            ])
            ->sum('qtyStockPartIn');
        $sumFlowOut = DB::table('flow_out_part')
            ->where('idPart', $id)
            ->where([
                ['firstApprovalPartOut', '=', 'Approved'],
                ['secondApprovalPartOut', '=', 'Approved'],
                ['thirdApprovalPartOut', '=', 'Approved'],
                ['fourthApprovalPartOut', '=', 'Approved']
            ])
            ->sum('qtyStockPartOut');

        $total = $sumFlowIn - $sumFlowOut;
        $category =  $queryFindRecords ->kategoriPart;
        $link = 'DetailItems.part-detail';
        return view($link , [
            'records' => $queryFindRecords,
            'flowInRecords' => $flowInRecords, 'flowOutRecords' => $flowOutRecords,
            'currenttotal' => $total,
            'category' => $category
        ]);
    }
    public function edit($id)
    {
        $part = Part::findOrFail($id);
        $category = $part->kategoriPart;
        $link = 'EditDataForm.part-edit';
        return view($link, ['data' => $part,'category'=>$category ]);
    }
    public function update(Request $request, $id)
    {
        $part = Part::findOrFail($id);
        $this->validate($request, [
            'namaPart' => 'required|string',
            'descPart' => 'required|string',
            'satuanPart' => 'required|string',
            'lokasiPart' => 'required|string',
            'size'=>'nullable'
        ]);
        $part->namaPart = ucwords($request->namaPart);
        $part->descPart = $request->descPart;
        $part->lokasiPart = ucwords($request->lokasiPart);
        $part->satuanPart = $request->satuanPart;
        
        if(!is_null($request->size)){
            $part->size = $request->size;
        }
        $checkSucces = $part->save();
        $category = $part->kategoriPart;
        // Session Flash
        if ($checkSucces) {
            Session::flash('statusUpdateElectrical', 'success');
            Session::flash('message', 'Berhasil mengupdate data '.$category);
        }
        
        return redirect($category);
    }
   public function traceRecords(Request $request, $id){
        $queryGetCategory = Part::find($id);
        
        $firstRange = $request->dtFirstRange;
        $secondRange = $request->dtSecondRange;

        $sumStockInBeforeRange = DB::table('flow_in_part')
            ->whereDate('dtStockPartApprovedIn', '<', $firstRange)
            ->where('idPart', $id)
            ->where([
                ['firstApprovalPartIn', '=', 'Approved'],
                ['secondApprovalPartIn', '=', 'Approved'],
                ['thirdApprovalPartIn', '=', 'Approved'],
                ['fourthApprovalPartIn','=', 'Approved']
            ])
            ->sum('qtyStockPartIn');

        $sumStockOutBeforeRange = DB::table('flow_out_part')
        ->whereDate('dtStockPartApprovedOut', '<', $firstRange)
            ->where('idPart', $id)
            ->where([
                ['firstApprovalPartOut', '=', 'Approved'],
                ['secondApprovalPartOut', '=', 'Approved'],
                ['thirdApprovalPartOut', '=', 'Approved'],
                ['fourthApprovalPartOut', '=', 'Approved']
            ])
            ->sum('qtyStockPartOut');

        $totalSumBeforeRange = $sumStockInBeforeRange - $sumStockOutBeforeRange;
        // dd($totalSumBeforeRange);                        
        // Proses join table in dan flow out
        $tableIn  = DB::table("flow_in_part")
        ->selectRaw(" 
                flow_in_part.noFtb AS noFTB, '' AS 'noFKB',
                flow_in_part.idPart,
                CONCAT(flow_in_part.dtStockPartApprovedIn,'') AS date,
                flow_in_part.qtyStockPartIn AS 'IN',0 AS 'OUT',
                flow_in_part.qtyStockPartIn-0 AS SALDO")
        ->whereBetween('flow_in_part.dtStockPartApprovedIn', [$firstRange, $secondRange])
        ->where([
                ['firstApprovalPartIn', '=', 'Approved'],
                ['secondApprovalPartIn', '=', 'Approved'],
                ['thirdApprovalPartIn', '=', 'Approved'],
                ['fourthApprovalPartIn', '=', 'Approved']
            ])
        ->where('idPart', $id);

        $tableFinal  = DB::table("flow_out_part")
        ->selectRaw("
                '' AS 'noFTB',
                flow_out_part.noFkb As noFKB,
                flow_out_part.idPart,
                CONCAT(flow_out_part.dtStockPartApprovedOut,'') AS date,
                0 AS 'IN',
                flow_out_part.qtyStockPartOut AS 'OUT',
                0-flow_out_part.qtyStockPartOut AS SALDO")
            ->whereBetween('flow_out_part.dtStockPartApprovedOut', [$firstRange, $secondRange])
            ->unionAll($tableIn)
            ->where('idPart', $id)
            ->orderBy('date', 'asc')
            ->where([
                ['firstApprovalPartOut', '=', 'Approved'],
                ['secondApprovalPartOut', '=', 'Approved'],
                ['thirdApprovalPartOut', '=', 'Approved'],
                ['fourthApprovalPartOut', '=', 'Approved']
            ])
            ->get();
        // dd($tableFinal);
        $category = $queryGetCategory->kategoriPart;
        $link  = 'TracePages.partTrace';
        return view(
            $link,
            [
                'firstRange' => $firstRange, 'secondRange' => $secondRange, 'tableFinal' => $tableFinal,
                'totalSumBeforeRange' => $totalSumBeforeRange
            ]
        );
   }


}
