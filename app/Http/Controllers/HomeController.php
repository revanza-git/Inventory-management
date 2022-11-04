<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Romans\Filter\IntToRoman;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(){
        $currYearDigit = date('Y');
        
        $currMonthDigit = date('m');
        $currMonthOneDigit =sprintf('%01d', $currMonthDigit);
        // $currMonth = date('F') . " " . $currYearDigit;
        // dd($currMonth);
      
        // COUNT IN
        if($currMonthOneDigit >= 1 && $currMonthOneDigit <= 3){
            $firstRange = date($currYearDigit . '-01-' . '01');
            $secondRange = date($currYearDigit . '-03-' . '31');
        }
        if ($currMonthOneDigit >= 4 && $currMonthOneDigit <= 6) {
            $firstRange = date($currYearDigit . '-04-' . '01');
            $secondRange = date($currYearDigit . '-06-' . '31');
        }
        if ($currMonthOneDigit >= 7 && $currMonthOneDigit <= 9) {
            $firstRange = date($currYearDigit . '-07-' . '01');
            $secondRange = date($currYearDigit . '-09-' . '30');
        }

        if ($currMonthOneDigit >= 10 && $currMonthOneDigit <= 12) {
            $firstRange = date($currYearDigit.'-10-'.'01');
            $secondRange = date($currYearDigit . '-12-' . '31');
        }

        if (Auth::user()->role == 'admin' || Auth::user()->role == 'master') {
            $countInElectrical = DB::table('flow_in_part')
            ->join('part', 'flow_in_part.idPart', '=', 'part.idPart')
            ->where('part.kategoriPart', '=', 'electrical')
            ->whereNotNull('flow_in_part.noFtb')
            ->whereBetween('flow_in_part.dtStockPartApprovedIn', [$firstRange, $secondRange])
                ->get()
                ->count();
            $countOutElectrical = DB::table('flow_out_part')
            ->join('part', 'flow_out_part.idPart', '=', 'part.idPart')
            ->where('part.kategoriPart', '=', 'electrical')
            ->whereNotNull('flow_out_part.noFkb')
            ->whereBetween('flow_out_part.dtStockPartApprovedOut', [$firstRange, $secondRange])
                ->get()
                ->count();

            $countInInstrument = DB::table('flow_in_part')
            ->join('part', 'flow_in_part.idPart', '=', 'part.idPart')
            ->where('part.kategoriPart', '=', 'instrument')
            ->whereNotNull('flow_in_part.noFtb')
            ->whereBetween('flow_in_part.dtStockPartApprovedIn', [$firstRange, $secondRange])
                ->get()
                ->count();
            $countOutInstrument = DB::table('flow_out_part')
            ->join('part', 'flow_out_part.idPart', '=', 'part.idPart')
            ->where('part.kategoriPart', '=', 'instrument')
            ->whereNotNull('flow_out_part.noFkb')
            ->whereBetween('flow_out_part.dtStockPartApprovedOut', [$firstRange, $secondRange])
                ->get()
                ->count();

            $countInMechanical = DB::table('flow_in_part')
            ->join('part', 'flow_in_part.idPart', '=', 'part.idPart')
            ->where('part.kategoriPart', '=', 'mechanical')
            ->whereNotNull('flow_in_part.noFtb')
            ->whereBetween('flow_in_part.dtStockPartApprovedIn', [$firstRange, $secondRange])
                ->get()
                ->count();
            $countOutMechanical = DB::table('flow_out_part')
            ->join('part', 'flow_out_part.idPart', '=', 'part.idPart')
            ->where('part.kategoriPart', '=', 'mechanical')
            ->whereNotNull('flow_out_part.noFkb')
            ->whereBetween('flow_out_part.dtStockPartApprovedOut', [$firstRange, $secondRange])
                ->get()
                ->count();

            $countInProvision = DB::table('flow_in_part')
            ->join('part', 'flow_in_part.idPart', '=', 'part.idPart')
            ->where('part.kategoriPart', '=', 'provision')
            ->whereNotNull('flow_in_part.noFtb')
            ->whereBetween('flow_in_part.dtStockPartApprovedIn', [$firstRange, $secondRange])
                ->get()
                ->count();
            $countOutProvision = DB::table('flow_out_part')
            ->join('part', 'flow_out_part.idPart', '=', 'part.idPart')
            ->where('part.kategoriPart', '=', 'provision')
            ->whereNotNull('flow_out_part.noFkb')
            ->whereBetween('flow_out_part.dtStockPartApprovedOut', [$firstRange, $secondRange])
                ->get()
                ->count();

            $countInEmergency = DB::table('flow_in_part')
            ->join('part', 'flow_in_part.idPart', '=', 'part.idPart')
            ->where('part.kategoriPart', '=', 'emergency')
            ->whereNotNull('flow_in_part.noFtb')
            ->whereBetween('flow_in_part.dtStockPartApprovedIn', [$firstRange, $secondRange])
                ->get()
                ->count();
            $countOutEmergency = DB::table('flow_out_part')
            ->join('part', 'flow_out_part.idPart', '=', 'part.idPart')
            ->where('part.kategoriPart', '=', 'emergency')
            ->whereNotNull('flow_out_part.noFkb')
            ->whereBetween('flow_out_part.dtStockPartApprovedOut', [$firstRange, $secondRange])
                ->get()
                ->count();

            $countInReliability = DB::table('flow_in_part')
            ->join('part', 'flow_in_part.idPart', '=', 'part.idPart')
            ->where('part.kategoriPart', '=', 'reliability')
            ->whereNotNull('flow_in_part.noFtb')
            ->whereBetween('flow_in_part.dtStockPartApprovedIn', [$firstRange, $secondRange])
                ->get()
                ->count();
            $countOutReliability = DB::table('flow_out_part')
            ->join('part', 'flow_out_part.idPart', '=', 'part.idPart')
            ->where('part.kategoriPart', '=', 'reliability')
            ->whereNotNull('flow_out_part.noFkb')
            ->whereBetween('flow_out_part.dtStockPartApprovedOut', [$firstRange, $secondRange])
                ->get()
                ->count();

            $countInScrap = DB::table('flow_in_part')
            ->join('part', 'flow_in_part.idPart', '=', 'part.idPart')
            ->where('part.kategoriPart', '=', 'scrap')
                ->whereNotNull('flow_in_part.noFtb')
                ->whereBetween('flow_in_part.dtStockPartApprovedIn', [$firstRange, $secondRange])
                ->get()
                ->count();
            $countOutScrap = DB::table('flow_out_part')
            ->join('part', 'flow_out_part.idPart', '=', 'part.idPart')
            ->where('part.kategoriPart', '=', 'scrap')
                ->whereNotNull('flow_out_part.noFkb')
                ->whereBetween('flow_out_part.dtStockPartApprovedOut', [$firstRange, $secondRange])
                ->get()
                ->count();
            $countInTechnology = DB::table('flow_in_part')
            ->join('part', 'flow_in_part.idPart', '=', 'part.idPart')
            ->where('part.kategoriPart', '=', 'technology')
            ->whereNotNull('flow_in_part.noFtb')
            ->whereBetween('flow_in_part.dtStockPartApprovedIn', [$firstRange, $secondRange])
                ->get()
                ->count();
            $countOutTechnology = DB::table('flow_out_part')
            ->join('part', 'flow_out_part.idPart', '=', 'part.idPart')
            ->where('part.kategoriPart', '=', 'technology')
            ->whereNotNull('flow_out_part.noFkb')
            ->whereBetween('flow_out_part.dtStockPartApprovedOut', [$firstRange, $secondRange])
                ->get()
                ->count();
            $countInTiyum  = DB::table('flow_in_part')
            ->join('part', 'flow_in_part.idPart', '=', 'part.idPart')
            ->where('part.kategoriPart', '=', 'tiyum')
                ->whereNotNull('flow_in_part.noFtb')
                ->whereBetween('flow_in_part.dtStockPartApprovedIn', [$firstRange, $secondRange])
                ->get()
                ->count();
            $countOutTiyum  = DB::table('flow_out_part')
            ->join('part', 'flow_out_part.idPart', '=', 'part.idPart')
            ->where('part.kategoriPart', '=', 'tiyum')
                ->whereNotNull('flow_out_part.noFkb')
                ->whereBetween('flow_out_part.dtStockPartApprovedOut', [$firstRange, $secondRange])
                ->get()
                ->count();
            $countInScrayum  = DB::table('flow_in_part')
            ->join('part', 'flow_in_part.idPart', '=', 'part.idPart')
            ->where('part.kategoriPart', '=', 'scrayum')
            ->whereNotNull('flow_in_part.noFtb')
            ->whereBetween('flow_in_part.dtStockPartApprovedIn', [$firstRange, $secondRange])
                ->get()
                ->count();
            $countOutScrayum  = DB::table('flow_out_part')
            ->join('part', 'flow_out_part.idPart', '=', 'part.idPart')
            ->where('part.kategoriPart', '=', 'scrayum')
            ->whereNotNull('flow_out_part.noFkb')
            ->whereBetween('flow_out_part.dtStockPartApprovedOut', [$firstRange, $secondRange])
                ->get()
                ->count();
            $countInSekper = DB::table('flow_in_part')
            ->join('part', 'flow_in_part.idPart', '=', 'part.idPart')
            ->where('part.kategoriPart', '=', 'sekper')
                ->whereNotNull('flow_in_part.noFtb')
                ->whereBetween('flow_in_part.dtStockPartApprovedIn', [$firstRange, $secondRange])
                ->get()
                ->count();
            $countOutSekper = DB::table('flow_out_part')
            ->join('part', 'flow_out_part.idPart', '=', 'part.idPart')
            ->where('part.kategoriPart', '=', 'sekper')
                ->whereNotNull('flow_out_part.noFkb')
                ->whereBetween('flow_out_part.dtStockPartApprovedOut', [$firstRange, $secondRange])
                ->get()
                ->count();
            $arrayLabel = array(
                "Electrical", "Instrument", "Mechanical", "Provision Tie In",
                "Emergency", "Reliability", "Scrap R & Q",
                "Titipan IT", "Titipan Layanan Umum",
                "Scrap Layanan Umum", "Titipan Sekretaris Perusahaan"
            );
            $countIn = array(
                $countInElectrical, $countInInstrument, $countInMechanical,
                $countInProvision, $countInEmergency, $countInReliability, $countInScrap,
                $countInTechnology, $countInTiyum, $countInScrayum, $countInSekper
            );
            $countOut = array(
                $countOutElectrical, $countOutInstrument, $countOutMechanical,
                $countOutProvision, $countOutEmergency, $countOutReliability, $countOutScrap,
                $countOutTechnology, $countOutTiyum, $countOutScrayum, $countOutSekper
            );
        }
        if (Auth::user()->departement == 'reliability') {
            $countInElectrical = DB::table('flow_in_part')
            ->join('part', 'flow_in_part.idPart', '=', 'part.idPart')
            ->where('part.kategoriPart', '=', 'electrical')
            ->whereNotNull('flow_in_part.noFtb')
            ->whereBetween('flow_in_part.dtStockPartApprovedIn', [$firstRange, $secondRange])
                ->get()
                ->count();
            $countOutElectrical = DB::table('flow_out_part')
            ->join('part', 'flow_out_part.idPart', '=', 'part.idPart')
            ->where('part.kategoriPart', '=', 'electrical')
            ->whereNotNull('flow_out_part.noFkb')
            ->whereBetween('flow_out_part.dtStockPartApprovedOut', [$firstRange, $secondRange])
                ->get()
                ->count();

            $countInInstrument = DB::table('flow_in_part')
            ->join('part', 'flow_in_part.idPart', '=', 'part.idPart')
            ->where('part.kategoriPart', '=', 'instrument')
            ->whereNotNull('flow_in_part.noFtb')
            ->whereBetween('flow_in_part.dtStockPartApprovedIn', [$firstRange, $secondRange])
                ->get()
                ->count();
            $countOutInstrument = DB::table('flow_out_part')
            ->join('part', 'flow_out_part.idPart', '=', 'part.idPart')
            ->where('part.kategoriPart', '=', 'instrument')
            ->whereNotNull('flow_out_part.noFkb')
            ->whereBetween('flow_out_part.dtStockPartApprovedOut', [$firstRange, $secondRange])
                ->get()
                ->count();

            $countInMechanical = DB::table('flow_in_part')
            ->join('part', 'flow_in_part.idPart', '=', 'part.idPart')
            ->where('part.kategoriPart', '=', 'mechanical')
            ->whereNotNull('flow_in_part.noFtb')
            ->whereBetween('flow_in_part.dtStockPartApprovedIn', [$firstRange, $secondRange])
                ->get()
                ->count();
            $countOutMechanical = DB::table('flow_out_part')
            ->join('part', 'flow_out_part.idPart', '=', 'part.idPart')
            ->where('part.kategoriPart', '=', 'mechanical')
            ->whereNotNull('flow_out_part.noFkb')
            ->whereBetween('flow_out_part.dtStockPartApprovedOut', [$firstRange, $secondRange])
                ->get()
                ->count();

            $countInProvision = DB::table('flow_in_part')
            ->join('part', 'flow_in_part.idPart', '=', 'part.idPart')
            ->where('part.kategoriPart', '=', 'provision')
            ->whereNotNull('flow_in_part.noFtb')
            ->whereBetween('flow_in_part.dtStockPartApprovedIn', [$firstRange, $secondRange])
                ->get()
                ->count();
            $countOutProvision = DB::table('flow_out_part')
            ->join('part', 'flow_out_part.idPart', '=', 'part.idPart')
            ->where('part.kategoriPart', '=', 'provision')
            ->whereNotNull('flow_out_part.noFkb')
            ->whereBetween('flow_out_part.dtStockPartApprovedOut', [$firstRange, $secondRange])
                ->get()
                ->count();

            $countInEmergency = DB::table('flow_in_part')
            ->join('part', 'flow_in_part.idPart', '=', 'part.idPart')
            ->where('part.kategoriPart', '=', 'emergency')
            ->whereNotNull('flow_in_part.noFtb')
            ->whereBetween('flow_in_part.dtStockPartApprovedIn', [$firstRange, $secondRange])
                ->get()
                ->count();
            $countOutEmergency = DB::table('flow_out_part')
            ->join('part', 'flow_out_part.idPart', '=', 'part.idPart')
            ->where('part.kategoriPart', '=', 'emergency')
            ->whereNotNull('flow_out_part.noFkb')
            ->whereBetween('flow_out_part.dtStockPartApprovedOut', [$firstRange, $secondRange])
                ->get()
                ->count();

            $countInReliability = DB::table('flow_in_part')
            ->join('part', 'flow_in_part.idPart', '=', 'part.idPart')
            ->where('part.kategoriPart', '=', 'reliability')
            ->whereNotNull('flow_in_part.noFtb')
            ->whereBetween('flow_in_part.dtStockPartApprovedIn', [$firstRange, $secondRange])
                ->get()
                ->count();
            $countOutReliability = DB::table('flow_out_part')
            ->join('part', 'flow_out_part.idPart', '=', 'part.idPart')
            ->where('part.kategoriPart', '=', 'reliability')
            ->whereNotNull('flow_out_part.noFkb')
            ->whereBetween('flow_out_part.dtStockPartApprovedOut', [$firstRange, $secondRange])
                ->get()
                ->count();

            $countInScrap = DB::table('flow_in_part')
            ->join('part', 'flow_in_part.idPart', '=', 'part.idPart')
            ->where('part.kategoriPart', '=', 'scrap')
                ->whereNotNull('flow_in_part.noFtb')
                ->whereBetween('flow_in_part.dtStockPartApprovedIn', [$firstRange, $secondRange])
                ->get()
                ->count();
            $countOutScrap = DB::table('flow_out_part')
            ->join('part', 'flow_out_part.idPart', '=', 'part.idPart')
            ->where('part.kategoriPart', '=', 'scrap')
                ->whereNotNull('flow_out_part.noFkb')
                ->whereBetween('flow_out_part.dtStockPartApprovedOut', [$firstRange, $secondRange])
                ->get()
                ->count();

            $arrayLabel = array(
                "Electrical", "Instrument", "Mechanical", "Provision Tie In",
                "Emergency", "Reliability", "Scrap R & Q"
            );
            $countIn = array(
                $countInElectrical, $countInInstrument, $countInMechanical,
                $countInProvision, $countInEmergency, $countInReliability, $countInScrap
            );
            $countOut = array(
                $countOutElectrical, $countOutInstrument, $countOutMechanical,
                $countOutProvision, $countOutEmergency, $countOutReliability, $countOutScrap
            );
        }
        if (Auth::user()->departement == 'technology') {
            $countInTechnology = DB::table('flow_in_part')
            ->join('part', 'flow_in_part.idPart', '=', 'part.idPart')
            ->where('part.kategoriPart', '=', 'technology')
            ->whereNotNull('flow_in_part.noFtb')
            ->whereBetween('flow_in_part.dtStockPartApprovedIn', [$firstRange, $secondRange])
                ->get()
                ->count();
            $countOutTechnology = DB::table('flow_out_part')
            ->join('part', 'flow_out_part.idPart', '=', 'part.idPart')
            ->where('part.kategoriPart', '=', 'technology')
            ->whereNotNull('flow_out_part.noFkb')
            ->whereBetween('flow_out_part.dtStockPartApprovedOut', [$firstRange, $secondRange])
                ->get()
                ->count();
            $arrayLabel = array("Technology");
            $countIn = array($countInTechnology);
            $countOut = array($countOutTechnology);
        }
        if (Auth::user()->departement == 'layum') {
            $countInTiyum  = DB::table('flow_in_part')
            ->join('part', 'flow_in_part.idPart', '=', 'part.idPart')
            ->where('part.kategoriPart', '=', 'tiyum')
                ->whereNotNull('flow_in_part.noFtb')
                ->whereBetween('flow_in_part.dtStockPartApprovedIn', [$firstRange, $secondRange])
                ->get()
                ->count();
            $countOutTiyum  = DB::table('flow_out_part')
            ->join('part', 'flow_out_part.idPart', '=', 'part.idPart')
            ->where('part.kategoriPart', '=', 'tiyum')
                ->whereNotNull('flow_out_part.noFkb')
                ->whereBetween('flow_out_part.dtStockPartApprovedOut', [$firstRange, $secondRange])
                ->get()
                ->count();
            $countInScrayum  = DB::table('flow_in_part')
            ->join('part', 'flow_in_part.idPart', '=', 'part.idPart')
            ->where('part.kategoriPart', '=', 'scrayum')
            ->whereNotNull('flow_in_part.noFtb')
            ->whereBetween('flow_in_part.dtStockPartApprovedIn', [$firstRange, $secondRange])
                ->get()
                ->count();
            $countOutScrayum  = DB::table('flow_out_part')
            ->join('part', 'flow_out_part.idPart', '=', 'part.idPart')
            ->where('part.kategoriPart', '=', 'scrayum')
            ->whereNotNull('flow_out_part.noFkb')
            ->whereBetween('flow_out_part.dtStockPartApprovedOut', [$firstRange, $secondRange])
                ->get()
                ->count();
            $arrayLabel = array("Titpan Layanan Umum", "Scrap Layanan Umum");
            $countIn = array($countInTiyum, $countInScrayum);
            $countOut = array($countOutTiyum, $countOutScrayum);
        }
        if (Auth::user()->departement == 'sekper') {
            $countInSekper = DB::table('flow_in_part')
            ->join('part', 'flow_in_part.idPart', '=', 'part.idPart')
            ->where('part.kategoriPart', '=', 'sekper')
                ->whereNotNull('flow_in_part.noFtb')
                ->whereBetween('flow_in_part.dtStockPartApprovedIn', [$firstRange, $secondRange])
                ->get()
                ->count();
            $countOutSekper = DB::table('flow_out_part')
            ->join('part', 'flow_out_part.idPart', '=', 'part.idPart')
            ->where('part.kategoriPart', '=', 'sekper')
                ->whereNotNull('flow_out_part.noFkb')
                ->whereBetween('flow_out_part.dtStockPartApprovedOut', [$firstRange, $secondRange])
                ->get()
                ->count();
            $arrayLabel = array("Titipan Sekretaris Perusahaan");
            $countIn = array($countInSekper);
            $countOut = array($countOutSekper);
        }
        return view('home',['month' => $currMonthOneDigit, 'flowInCurr'=>$countIn, 'flowOutCurr' => $countOut,'label'=>$arrayLabel,'year'=> $currYearDigit]);
    }

    

}
