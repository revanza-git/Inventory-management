<?php

namespace App\Http\Controllers;

use App\Exports\PartsExport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Part;
use Doctrine\DBAL\Schema\View;
use Maatwebsite\Excel\Facades\Excel;
use Romans\Filter\IntToRoman;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class ReportController extends Controller
{
    public function index(){
        $arrayYear = array();
        $queryIn = DB::table('flow_in_part')
                ->select('dtStockPartApprovedIn')
                ->whereNotNull('dtStockPartApprovedIn')
                ->distinct('dtStockPartApprovedIn')
                ->get();
        foreach($queryIn as $q){
            $year = date("Y", strtotime($q->dtStockPartApprovedIn));
            array_push($arrayYear,$year);
        }
        
        $queryOut = DB::table('flow_out_part')
                ->select('dtStockPartApprovedOut')
                ->whereNotNull('dtStockPartApprovedOut')
                ->distinct()
                ->get();
        foreach ($queryOut as $q) {
            $year = date("Y", strtotime($q->dtStockPartApprovedOut));
            array_push($arrayYear, $year);
        }
        $arrayYearUnique = array_unique($arrayYear);
        
        return view('ReportPages.reportIndex',['year'=>$arrayYearUnique]);
    }

    public function showReport(Request $request){
        ;
        $kategoriPart = $request->kategoriPart;
        $triwulan = $request->triwulan;
        $year = $request->year;

        $filter = new IntToRoman();
        $noTriwulan = $filter->filter($triwulan);

        $parts = Part::with('flowInPart', 'flowOutPart')
                ->where('kategoriPart', '=', $kategoriPart)
                ->get();
    
        if($triwulan==1){
            $firstRange = date($year . '-01-' . '01');
            $secondRange = date($year . '-03-' . '31');
        }
        if ($triwulan == 2) {
            $firstRange = date($year . '-04-' . '01');
            $secondRange = date($year . '-06-' . '30');
        }
        if ($triwulan == 3) {
            $firstRange = date($year . '-07-' . '01');
            $secondRange = date($year . '-09-' . '30');
        }
        if ($triwulan == 4) {
            $firstRange = date($year . '-10-' . '01');
            $secondRange = date($year . '-12-' . '31'); 
        }
        foreach ($parts as $i => $part) {
            $parts[$i]->stockAwal = $part->getStock($firstRange);
            $parts[$i]->stockAkhir = $part->getStock($secondRange);
        }
        return view('ReportPages.showReport',
        ['list' => $parts,'triwulan' => $noTriwulan, 'year' => $year,
        'kategori'=>$kategoriPart, 'firstRange' => $firstRange,'secondRange' => $secondRange]);
    }

    public function showReportKategoriMaterial(Request $request)
    {
        $kategoriPart = $request->kategoriPart;
        $triwulan = (int)$request->triwulan;
        $year = $request->year;
        $kategoriMaterial = $request->kategoriMaterial;
        $filter = new IntToRoman();
        $noTriwulan = $filter->filter($triwulan);

        $parts = Part::with('flowInPart', 'flowOutPart')
        ->where('kategoriPart', '=', $kategoriPart)
        ->where('kategoriMaterial', '=', $kategoriMaterial)
        ->get();
        if ($triwulan == 1) {
            $firstRange = date($year . '-01-' . '01');
            $secondRange = date($year . '-03-' . '31');
        }
        if ($triwulan == 2) {
            $firstRange = date($year . '-04-' . '01');
            $secondRange = date($year . '-06-' . '31');
        }
        if ($triwulan == 3) {
            $firstRange = date($year . '-07-' . '01');
            $secondRange = date($year . '-09-' . '30');
        }
        if ($triwulan == 4) {
            $firstRange = date($year . '-10-' . '01');
            $secondRange = date($year . '-12-' . '31');
        }
        foreach ($parts as $i => $part) {
            $parts[$i]->stockAwal = $part->getStock($firstRange);
            $parts[$i]->stockAkhir = $part->getStock($secondRange);
        }
        return view(
            'ReportPages.showReportKategori',
            [
                'list' => $parts, 'triwulan' => $noTriwulan, 'year' => $year,
                'kategori' => $kategoriPart, 'firstRange' => $firstRange, 'secondRange' => $secondRange,
                'material'=>$kategoriMaterial
            ]
        );
    }
    public function showReportLokasi(Request $request)
    {   
        $kategoriPart = $request->kategoriPart;
        $triwulan = (int)$request->triwulan;
        $year = $request->year;
        $lokasiPart = $request->lokasiPart;
        $filter = new IntToRoman();
        $noTriwulan = $filter->filter($triwulan);

        $parts = Part::with('flowInPart', 'flowOutPart')
            ->where('kategoriPart', '=', $kategoriPart)
            ->where('lokasiPart', '=', $lokasiPart)
            ->get();
        if ($triwulan == 1) {
            $firstRange = date($year . '-01-' . '01');
            $secondRange = date($year . '-03-' . '31');
        }
        if ($triwulan == 2) {
            $firstRange = date($year . '-04-' . '01');
            $secondRange = date($year . '-06-' . '31');
        }
        if ($triwulan == 3) {
            $firstRange = date($year . '-07-' . '01');
            $secondRange = date($year . '-09-' . '30');
        }
        if ($triwulan == 4) {
            $firstRange = date($year . '-10-' . '01');
            $secondRange = date($year . '-12-' . '31');
        }
        foreach ($parts as $i => $part) {
            $parts[$i]->stockAwal = $part->getStock($firstRange);
            $parts[$i]->stockAkhir = $part->getStock($secondRange);
        }
        return view(
            'ReportPages.showReportLokasi',
            [
                'list' => $parts, 'triwulan' => $noTriwulan, 'year' => $year,
                'kategori' => $kategoriPart, 'firstRange' => $firstRange, 'secondRange' => $secondRange,
                'lokasiPart' => $lokasiPart
            ]
        );
    }
    public function showReportAll(Request $request)
    {
        $kategoriPart = $request->kategoriPart;
        $triwulan = (int)$request->triwulan;
        $year = $request->year;
        $kategoriMaterial = $request->kategoriMaterial;
        $lokasiPart = $request->lokasiPart;
        $filter = new IntToRoman();
        $noTriwulan = $filter->filter($triwulan);

        $parts = Part::with('flowInPart', 'flowOutPart')
                ->where('kategoriPart', '=', $kategoriPart)
                ->where('kategoriMaterial', '=', $kategoriMaterial)
                ->where('lokasiPart', '=', $lokasiPart)
                ->get();
        if ($triwulan == 1) {
            $firstRange = date($year . '-01-' . '01');
            $secondRange = date($year . '-03-' . '31');
        }
        if ($triwulan == 2) {
            $firstRange = date($year . '-04-' . '01');
            $secondRange = date($year . '-06-' . '31');
        }
        if ($triwulan == 3) {
            $firstRange = date($year . '-07-' . '01');
            $secondRange = date($year . '-09-' . '30');
        }
        if ($triwulan == 4) {
            $firstRange = date($year . '-10-' . '01');
            $secondRange = date($year . '-12-' . '31');
        }
        foreach ($parts as $i => $part) {
            $parts[$i]->stockAwal = $part->getStock($firstRange);
            $parts[$i]->stockAkhir = $part->getStock($secondRange);
        }
        return view(
            'ReportPages.showReportAll',
            [
                'list' => $parts, 'triwulan' => $noTriwulan, 'year' => $year,
                'kategori' => $kategoriPart, 'firstRange' => $firstRange, 'secondRange' => $secondRange,
                'lokasiPart' => $lokasiPart, 'material' => $kategoriMaterial
            ]
        );
    }

    // EXPORT TRIWULAN
    public function exportReport(Request $request){
       $kategori = $request->kategori;
       $triwulan = $request->triwulan;
       $year = $request->year;
       $firstRange = $request->firstRange;
       $secondRange = $request->secondRange;
       return Excel::download(new PartsExport($firstRange, $secondRange,$kategori,NULL,NULL), 
       'Report '.ucwords($kategori).' '.'Triwulan '.$triwulan.' '.'Tahun'.' '.$year.'.xlsx');
    }
    public function exportCategoryReport(Request $request)
    {
        $kategori = $request->kategori;
        $triwulan = $request->triwulan;
        $year = $request->year;
        $kategoriMaterial = $request->kategoriMaterial;
        $firstRange = $request->firstRange;
        $secondRange = $request->secondRange;
        
     
        return Excel::download(
            new PartsExport($firstRange, $secondRange, $kategori,$kategoriMaterial,NULL),
            'Report '.ucwords($kategoriMaterial).' '. ucwords($kategori) . ' ' . 'Triwulan ' . $triwulan . ' ' . 'Tahun' . ' ' . 
            $year . '.xlsx'
        );
    }

    public function exportLokasiReport(Request $request)
    {   
        $kategori = $request->kategori;
        $triwulan = $request->triwulan;
        $year = $request->year;
        $lokasiPart = $request->lokasiPart;
        $firstRange = $request->firstRange;
        $secondRange = $request->secondRange;


        return Excel::download(
            new PartsExport($firstRange, $secondRange, $kategori, NULL,$lokasiPart),
            'Report ' . ucwords($kategori) .' ' .ucwords($lokasiPart).' ' . 'Triwulan ' . $triwulan . ' ' . 'Tahun' . ' ' .
                $year . '.xlsx'
        );
    }

    public function exportAllReport(Request $request){
        $kategori = $request->kategori;
        $triwulan = $request->triwulan;
        $year = $request->year;
        $lokasiPart = $request->lokasiPart;
        $firstRange = $request->firstRange;
        $secondRange = $request->secondRange;
        $kategoriMaterial = $request->kategoriMaterial;

        return Excel::download(
            new PartsExport($firstRange, $secondRange, $kategori,$kategoriMaterial, $lokasiPart),
            'Report '.ucwords($kategoriMaterial).' ' . ucwords($kategori) . ' ' . ucwords($lokasiPart) . ' ' . 'Triwulan ' . $triwulan . ' ' . 'Tahun' . ' ' .$year . '.xlsx'
        );


    }



    public function showCustomReport(Request $request){
        $kategoriPart = $request->kategoriPart;
        $firstRange = $request->dtFirstRange;
        $secondRange = $request->dtSecondRange;
     
        $parts = Part::with('flowInPart', 'flowOutPart')
                ->where('kategoriPart', '=', $kategoriPart)
                ->get();
       
        foreach ($parts as $i => $part) {
            $parts[$i]->stockAwal = $part->getStock($firstRange);
            $parts[$i]->stockAkhir = $part->getStock($secondRange);
        }
      
        return view(
            'ReportPages.showCustomReport',
            [
                'list' => $parts, 'kategori' => $kategoriPart, 'firstRange' => $firstRange, 'secondRange' => $secondRange,
                
            ]
        );

    }
    public function showCustomReportKategoriMaterial(Request $request){
        $kategoriPart = $request->kategoriPart;
        $kategoriMaterial = $request->kategoriMaterial;
        $firstRange = $request->dtFirstRange;
        $secondRange = $request->dtSecondRange;
        

        $parts = Part::with('flowInPart', 'flowOutPart')
                ->where('kategoriPart', '=', $kategoriPart)
                ->where('kategoriMaterial', '=', $kategoriMaterial)
                ->get();

        foreach ($parts as $i => $part) {
            $parts[$i]->stockAwal = $part->getStock($firstRange);
            $parts[$i]->stockAkhir = $part->getStock($secondRange);
        }

        return view(
            'ReportPages.showCustomKategoriReport',
            [
                'list' => $parts, 'kategori' => $kategoriPart, 'firstRange' => $firstRange, 'secondRange' => $secondRange,
                'material' => $kategoriMaterial

            ]
        );
    }
    public function showCustomReportLokasi(Request  $request){
        // dd($request);
        $kategoriPart = $request->kategoriPart;
        $lokasiPart = $request->lokasiPart;
        $firstRange = $request->dtFirstRange;
        $secondRange = $request->dtSecondRange;

        $parts = Part::with('flowInPart', 'flowOutPart')
            ->where('kategoriPart', '=', $kategoriPart)
            ->where('lokasiPart', '=', $lokasiPart)
            ->get();

        foreach ($parts as $i => $part) {
            $parts[$i]->stockAwal = $part->getStock($firstRange);
            $parts[$i]->stockAkhir = $part->getStock($secondRange);
        }
        
        return view(
            'ReportPages.showCustomLokasiReport',
            [
                'list' => $parts, 'kategori' => $kategoriPart, 'firstRange' => $firstRange, 'secondRange' => $secondRange,
                'lokasi' => $lokasiPart

            ]
        );
    }
    public function showCustomReportAll(Request $request){
        // dd($request);
        $kategoriPart = $request->kategoriPart;
        $kategoriMaterial = $request->kategoriMaterial;
        $lokasiPart = $request->lokasiPart;
        $firstRange = $request->dtFirstRange;
        $secondRange = $request->dtSecondRange;

        $parts = Part::with('flowInPart', 'flowOutPart')
                ->where('kategoriPart', '=', $kategoriPart)
                ->where('kategoriMaterial', '=', $kategoriMaterial)
                ->where('lokasiPart', '=', $lokasiPart)
                ->get();
        foreach ($parts as $i => $part) {
            $parts[$i]->stockAwal = $part->getStock($firstRange);
            $parts[$i]->stockAkhir = $part->getStock($secondRange);
        }
        return view(
            'ReportPages.showCustomAllReport',
            [
                'list' => $parts,
                'kategori' => $kategoriPart, 'firstRange' => $firstRange, 'secondRange' => $secondRange,
                'lokasiPart' => $lokasiPart, 'material' => $kategoriMaterial
            ]
        );
    }


    public function exportCustomReport(Request $request){
        $kategori = $request->kategori;
        $firstRange = $request->firstRange;
        $secondRange = $request->secondRange;
        $firstRangeConv = Carbon::parse($firstRange)->isoFormat('LL');
        $secondRangeConv = Carbon::parse($secondRange)->isoFormat('LL');
        return Excel::download(
            new PartsExport($firstRange, $secondRange, $kategori,NULL,NULL),
            'Report ' . ucwords($kategori) . ' ' . 'Periode ' . $firstRangeConv . ' ' . '-' . ' ' . $secondRangeConv . '.xlsx'
        );
    }

    public function exportCustomCategoryReport(Request $request){
        // dd($request);
        $kategori = $request->kategori;
        $kategoriMaterial = $request->kategoriMaterial;
        $firstRange = $request->firstRange;
        $secondRange = $request->secondRange;
        $firstRangeConv = Carbon::parse($firstRange)->isoFormat('LL');
        $secondRangeConv = Carbon::parse($secondRange)->isoFormat('LL');    
        

        return Excel::download(
            new PartsExport($firstRange, $secondRange, $kategori, $kategoriMaterial, NULL),
            'Report ' . ucwords($kategoriMaterial) . ' ' . ucwords($kategori) . ' ' .'Periode ' . $firstRangeConv . ' ' . '-' . ' ' . $secondRangeConv . '.xlsx'
        );
    }

    public function exportCustomLokasiReport(Request $request){
        $kategori = $request->kategori;
        $triwulan = $request->triwulan;
        $year = $request->year;
        $lokasiPart = $request->lokasiPart;
        $firstRange = $request->firstRange;
        $secondRange = $request->secondRange;
        $firstRangeConv = Carbon::parse($firstRange)->isoFormat('LL');
        $secondRangeConv = Carbon::parse($secondRange)->isoFormat('LL');  


        return Excel::download(
            new PartsExport($firstRange, $secondRange, $kategori, NULL, $lokasiPart),
            'Report ' . ucwords($kategori) . ' ' . ucwords($lokasiPart) . ' ' . 'Periode ' . $firstRangeConv . ' ' . '-' . ' ' . $secondRangeConv . '.xlsx'
        );
    }

    public function exportCustomAllReport(Request $request){
        $kategori = $request->kategori;
        $lokasiPart = $request->lokasiPart;
        $firstRange = $request->firstRange;
        $secondRange = $request->secondRange;
        $kategoriMaterial = $request->kategoriMaterial;
        $firstRangeConv = Carbon::parse($firstRange)->isoFormat('LL');
        $secondRangeConv = Carbon::parse($secondRange)->isoFormat('LL');  

        return Excel::download(
            new PartsExport($firstRange, $secondRange, $kategori, $kategoriMaterial, $lokasiPart),
            'Report ' . ucwords($kategoriMaterial) . ' ' . ucwords($kategori) . ' ' . ucwords($lokasiPart) . ' '. 'Periode ' 
             .$firstRangeConv . ' ' . '-' . ' ' . $secondRangeConv . '.xlsx'
        );
    }
}
