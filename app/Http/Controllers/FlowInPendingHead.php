<?php

namespace App\Http\Controllers;

use App\Models\HistoryIn;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\FlowInPart;

class FlowInPendingHead extends Controller
{
    public function index(){

        if(Auth::user()->departement == 'reliability'){
            $query = DB::table('flow_in_part')
                ->join('part', 'flow_in_part.idPart', '=', 'part.idPart')
                ->select(
                    'flow_in_part.dtStockPartIn',
                    'flow_in_part.nameRequester',
                    'flow_in_part.departmentRequester',
                    'part.lokasiPart',
                    'part.kategoriMaterial',
                )
                ->where('flow_in_part.firstApprovalPartIn', '=', 'Approved')
                ->where('flow_in_part.thirdApprovalDocsPartIn', '=', 'Waiting For Approval')
                ->where(function($query) {
                    $query->where('part.kategoriPart', '=', 'electrical')
                        ->orWhere('part.kategoriPart', '=', 'instrument')
                        ->orWhere('part.kategoriPart', '=', 'mechanical')
                        ->orWhere('part.kategoriPart', '=', 'provision')
                        ->orWhere('part.kategoriPart', '=', 'emergency')
                        ->orWhere('part.kategoriPart', '=', 'reliability')
                        ->orWhere('part.kategoriPart', '=', 'scrap');
                    })
                ->whereNull('flow_in_part.noFtb')
                ->orderBy('flow_in_part.dtStockPartIn', 'desc')
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
                    'part.kategoriMaterial',
                )
                ->where('flow_in_part.firstApprovalPartIn', '=', 'Approved')
                ->where('flow_in_part.thirdApprovalDocsPartIn', '=', 'Waiting For Approval')
                ->where(function ($query) {
                    $query->where('part.kategoriPart', '=', 'tiyum')
                        ->orWhere('part.kategoriPart', '=', 'scrayum');
                })
                ->whereNull('flow_in_part.noFtb')
                ->orderBy('flow_in_part.dtStockPartIn', 'desc')
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
                'part.kategoriMaterial',
            )
                ->where('flow_in_part.firstApprovalPartIn', '=', 'Approved')
                ->where('flow_in_part.thirdApprovalDocsPartIn', '=', 'Waiting For Approval')
                ->whereNull('flow_in_part.noFtb')
                ->where('part.kategoriPart', '=', 'technology')
                ->orderBy('flow_in_part.dtStockPartIn', 'desc')
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
                'part.kategoriMaterial',
            )
                ->where('flow_in_part.firstApprovalPartIn', '=', 'Approved')
                ->where('flow_in_part.thirdApprovalDocsPartIn', '=', 'Waiting For Approval')
                ->whereNull('flow_in_part.noFtb')
                ->where('part.kategoriPart', '=', 'sekper')
                ->orderBy('flow_in_part.dtStockPartIn', 'desc')
                ->distinct()
                ->get();
        }

        if (Auth::user()->departement == 'hsse') {
            $query = DB::table('flow_in_part')
            ->join('part', 'flow_in_part.idPart', '=', 'part.idPart')
            ->select(
                'flow_in_part.dtStockPartIn',
                'flow_in_part.nameRequester',
                'flow_in_part.departmentRequester',
                'part.lokasiPart',
                'part.kategoriMaterial',
            )
                ->where('flow_in_part.firstApprovalPartIn', '=', 'Approved')
                ->where('flow_in_part.thirdApprovalDocsPartIn', '=', 'Waiting For Approval')
                ->whereNull('flow_in_part.noFtb')
                ->where('part.kategoriPart', '=', 'hsse')
                ->orderBy('flow_in_part.dtStockPartIn', 'desc')
                ->distinct()
                ->get();
        }

        if (Auth::user()->departement == 'migas') {
            $query = DB::table('flow_in_part')
            ->join('part', 'flow_in_part.idPart', '=', 'part.idPart')
            ->select(
                'flow_in_part.dtStockPartIn',
                'flow_in_part.nameRequester',
                'flow_in_part.departmentRequester',
                'part.lokasiPart',
                'part.kategoriMaterial',
            )
                ->where('flow_in_part.firstApprovalPartIn', '=', 'Approved')
                ->where('flow_in_part.thirdApprovalDocsPartIn', '=', 'Waiting For Approval')
                ->whereNull('flow_in_part.noFtb')
                ->where('part.kategoriPart', '=', 'gasorf')
                ->orderBy('flow_in_part.dtStockPartIn', 'desc')
                ->distinct()
                ->get();
        }

        if (Auth::user()->departement == 'transportasi') {
            $query = DB::table('flow_in_part')
            ->join('part', 'flow_in_part.idPart', '=', 'part.idPart')
            ->select(
                'flow_in_part.dtStockPartIn',
                'flow_in_part.nameRequester',
                'flow_in_part.departmentRequester',
                'part.lokasiPart',
                'part.kategoriMaterial',
            )
                ->where('flow_in_part.firstApprovalPartIn', '=', 'Approved')
                ->where('flow_in_part.thirdApprovalDocsPartIn', '=', 'Waiting For Approval')
                ->whereNull('flow_in_part.noFtb')
                ->where('part.kategoriPart', '=', 'transportasi')
                ->orderBy('flow_in_part.dtStockPartIn', 'desc')
                ->distinct()
                ->get();
        }

        if (Auth::user()->departement == 'bisnis') {
            $query = DB::table('flow_in_part')
            ->join('part', 'flow_in_part.idPart', '=', 'part.idPart')
            ->select(
                'flow_in_part.dtStockPartIn',
                'flow_in_part.nameRequester',
                'flow_in_part.departmentRequester',
                'part.lokasiPart',
                'part.kategoriMaterial',
            )
                ->where('flow_in_part.firstApprovalPartIn', '=', 'Approved')
                ->where('flow_in_part.thirdApprovalDocsPartIn', '=', 'Waiting For Approval')
                ->whereNull('flow_in_part.noFtb')
                ->where('part.kategoriPart', '=', 'bisnis')
                ->orderBy('flow_in_part.dtStockPartIn', 'desc')
                ->distinct()
                ->get();
        }
        // dd($query);
        return view('ApprovalHeadPages.flowInPendingHead',['dataset' => $query]);
    }

    public function showAllPendingIn($date,$name,$lokasi,$department,$material){
        
        $query = DB::table('flow_in_part')
        ->join('part', 'flow_in_part.idPart', '=', 'part.idPart')
        ->select(
            'flow_in_part.id_flowInPart',
            'flow_in_part.noPart',
            'part.namaPart',
            'part.size',
            'flow_in_part.qtyStockPartIn',
            'part.satuanPart',
            'flow_in_part.priceStockPartIn',
            'flow_in_part.needsStockPartIn',
            'flow_in_part.firstApprovalPartIn',
            'flow_in_part.timeFirstApprovalPartIn',
            'flow_in_part.secondApprovalPartIn',
            'flow_in_part.timeSecondApprovalPartIn',
            'flow_in_part.filePhotoPartIn',
            'flow_in_part.filePO',
            'flow_in_part.fileBAST',
        )
        ->where('flow_in_part.firstApprovalPartIn', '=', 'Approved')
        ->where('flow_in_part.thirdApprovalDocsPartIn', '=', 'Waiting For Approval')
        ->whereNull('flow_in_part.noFtb')
        ->where('flow_in_part.dtStockPartIn', '=', $date)
        ->where('flow_in_part.nameRequester', '=', $name)
        ->where('part.lokasiPart', '=', $lokasi)
        ->where('part.kategoriMaterial', '=', $material)
        ->get();
        
        return view('ApprovalHeadPages.approveInHead',['list'=>$query,'date'=> $date,'name'=>$name,'lokasi'=>$lokasi, 'department'=>$department]);
    }

    public function approveAllIn(Request $request)
    {
        $arrayId = $request->arrayOfId;
        $currTime = Carbon::now()->format('d, M Y [H:i:s]');
        $pic = auth()->user()->name;
        // $signature =Auth::user()->signature;
        foreach ($arrayId as $id) {
            $data = FlowInPart::find($id);
            $data->thirdApprovalDocsPartIn = 'Approved';
            $data->ReasonThirdApprovalDocsPartIn = NULL;
            $data->timeThirdApprovalDocsPartIn = $currTime;
            $data->nameThirdApprovalDocsPartIn = $pic;
            $data->save();

            $history = new HistoryIn();
            $history->status = "Approve Dokumen (HEAD)";
            $history->timeStatus = $currTime;
            $history->name = auth()->user()->name;
            $history->id_flowInPart = $id;
            $history->save();
        }

        $attributePart = FlowInPart::findOrFail($id);

        $namaRequester = $attributePart->nameRequester;
        $departmentRequester = $attributePart->departmentRequester;

        $email = User::where('role', 'admin')
                ->where('departement', 'procurement')
                ->pluck('email')
                ->toArray();
        $emailString = implode(', ', $email);

        $mail = config('mail.from.address');

        $mail_data = [
            'fromEmail' => $mail,
            'fromName' => 'Sunter & ORF Warehouse (SINV)',
            'recipient' => $emailString,
            'subject' => 'Pengajuan Formulir Terima Barang',
            'body' => "$namaRequester dari Departemen $departmentRequester mengajukan dokumen Formulir Terima Barang(FTB). Yuk segera di approve :)",
        ];
        // \Mail::send('email-template',$mail_data, function($message) use ($mail_data){
        //     $message->to($mail_data['recipient'])
        //             ->from($mail_data['fromEmail'], $mail_data['fromName'])
        //             ->subject($mail_data['subject']);
        // });

        return redirect('/flowInPendingHead')->with('success', 'Berhasil Approve Satu Request');
    }

    public function revisionAllIn(Request $request){
       
        $arrayId = $request->arrayOfId;
        $currTime = Carbon::now()->format('d, M Y [H:i:s]');
        $pic = auth()->user()->name;

        foreach ($arrayId as $id) {
            $data = FlowInPart::find($id);
            $data->thirdApprovalDocsPartIn = 'Revision';
            $data->ReasonThirdApprovalDocsPartIn= $request->ReasonThirdApprovalDocsPartIn;
            $data->timeThirdApprovalDocsPartIn = $currTime;
            $data->nameThirdApprovalDocsPartIn = $pic;
            $data->save();

            $history = new HistoryIn();
            $history->status = "Revisi Dokumen (HEAD)";
            $history->timeStatus = $currTime;
            $history->name = auth()->user()->name;
            $history->reason = $request->ReasonThirdApprovalDocsPartIn;
            $history->id_flowInPart = $id;
            $history->save();
        }
        return redirect('/flowInPendingHead')->with('success', 'Berhasil Revisi Dokumen Satu Request');
    }

    public function indexFinal(){

        if (Auth::user()->departement == 'reliability') {
            $query = DB::table('flow_in_part')
            ->join('part', 'flow_in_part.idPart', '=', 'part.idPart')
            ->select(
                'flow_in_part.nameRequester',
                'flow_in_part.departmentRequester',
                'flow_in_part.noFtb'
            )
                ->where('flow_in_part.thirdApprovalPartIn', '=', 'Waiting For Approval')
                ->where('flow_in_part.fourthApprovalPartIn', '=', 'Waiting For Approval')
                ->whereNotNull('flow_in_part.noFtb')
                ->where(function ($query) {
                    $query->where('part.kategoriPart', '=', 'electrical')
                    ->orWhere('part.kategoriPart', '=', 'instrument')
                    ->orWhere('part.kategoriPart', '=', 'mechanical')
                    ->orWhere('part.kategoriPart', '=', 'provision')
                    ->orWhere('part.kategoriPart', '=', 'emergency')
                    ->orWhere('part.kategoriPart', '=', 'reliability')
                    ->orWhere('part.kategoriPart', '=', 'scrap');
                })
                
                ->distinct()
                ->get();
        }
        if (Auth::user()->departement == 'layum') {
            $query = DB::table('flow_in_part')
            ->join('part', 'flow_in_part.idPart', '=', 'part.idPart')
            ->select(
                'flow_in_part.nameRequester',
                'flow_in_part.departmentRequester',
                'flow_in_part.noFtb'
            )
                ->where('flow_in_part.thirdApprovalPartIn', '=', 'Waiting For Approval')
                ->where('flow_in_part.fourthApprovalPartIn', '=', 'Waiting For Approval')
                ->whereNotNull('flow_in_part.noFtb')
                ->where(function ($query) {
                    $query->where('part.kategoriPart', '=', 'tiyum')
                        ->orWhere('part.kategoriPart', '=', 'scrayum');
                })
                ->distinct()
                ->get();
        }
        if (Auth::user()->departement == 'technology') {
            $query = DB::table('flow_in_part')
            ->join('part', 'flow_in_part.idPart', '=', 'part.idPart')
            ->select(
                'flow_in_part.nameRequester',
                'flow_in_part.departmentRequester',
                'flow_in_part.noFtb'
            )
                ->where('flow_in_part.thirdApprovalPartIn', '=', 'Waiting For Approval')
                ->where('flow_in_part.fourthApprovalPartIn', '=', 'Waiting For Approval')
                ->whereNotNull('flow_in_part.noFtb')
                ->where('part.kategoriPart', '=', 'technology')
                ->distinct()
                ->get();
        }
        if (Auth::user()->departement == 'sekper') {
            $query = DB::table('flow_in_part')
            ->join('part', 'flow_in_part.idPart', '=', 'part.idPart')
            ->select(
                'flow_in_part.nameRequester',
                'flow_in_part.departmentRequester',
                'flow_in_part.noFtb'
            )
                ->where('flow_in_part.thirdApprovalPartIn', '=', 'Waiting For Approval')
                ->where('flow_in_part.fourthApprovalPartIn', '=', 'Waiting For Approval')
                ->whereNotNull('flow_in_part.noFtb')
                ->where('part.kategoriPart', '=', 'sekper')
                ->distinct()
                ->get();
        }

        if (Auth::user()->departement == 'hsse') {
            $query = DB::table('flow_in_part')
            ->join('part', 'flow_in_part.idPart', '=', 'part.idPart')
            ->select(
                'flow_in_part.nameRequester',
                'flow_in_part.departmentRequester',
                'flow_in_part.noFtb'
            )
                ->where('flow_in_part.thirdApprovalPartIn', '=', 'Waiting For Approval')
                ->where('flow_in_part.fourthApprovalPartIn', '=', 'Waiting For Approval')
                ->whereNotNull('flow_in_part.noFtb')
                ->where('part.kategoriPart', '=', 'hsse')
                ->distinct()
                ->get();
        }

        if (Auth::user()->departement == 'migas') {
            $query = DB::table('flow_in_part')
            ->join('part', 'flow_in_part.idPart', '=', 'part.idPart')
            ->select(
                'flow_in_part.nameRequester',
                'flow_in_part.departmentRequester',
                'flow_in_part.noFtb'
            )
                ->where('flow_in_part.thirdApprovalPartIn', '=', 'Waiting For Approval')
                ->where('flow_in_part.fourthApprovalPartIn', '=', 'Waiting For Approval')
                ->whereNotNull('flow_in_part.noFtb')
                ->where('part.kategoriPart', '=', 'gasorf')
                ->distinct()
                ->get();
        }

        if (Auth::user()->departement == 'transportasi') {
            $query = DB::table('flow_in_part')
            ->join('part', 'flow_in_part.idPart', '=', 'part.idPart')
            ->select(
                'flow_in_part.nameRequester',
                'flow_in_part.departmentRequester',
                'flow_in_part.noFtb'
            )
                ->where('flow_in_part.thirdApprovalPartIn', '=', 'Waiting For Approval')
                ->where('flow_in_part.fourthApprovalPartIn', '=', 'Waiting For Approval')
                ->whereNotNull('flow_in_part.noFtb')
                ->where('part.kategoriPart', '=', 'transportasi')
                ->distinct()
                ->get();
        }

        if (Auth::user()->departement == 'bisnis') {
            $query = DB::table('flow_in_part')
            ->join('part', 'flow_in_part.idPart', '=', 'part.idPart')
            ->select(
                'flow_in_part.nameRequester',
                'flow_in_part.departmentRequester',
                'flow_in_part.noFtb'
            )
                ->where('flow_in_part.thirdApprovalPartIn', '=', 'Waiting For Approval')
                ->where('flow_in_part.fourthApprovalPartIn', '=', 'Waiting For Approval')
                ->whereNotNull('flow_in_part.noFtb')
                ->where('part.kategoriPart', '=', 'bisnis')
                ->distinct()
                ->get();
        }
        // dd($query);
        return view('ApprovalHeadPages.flowInFinalHead', ['dataset' => $query]);
    }

    public function showDetailFinalFlowIn(Request $request){
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
                    'part.kategoriPart',
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
                )
                ->where('flow_in_part.noFtb', '=', $noFtb)
                ->get();
        return view(
            'ApprovalHeadPages.detailFlowInFinal',
            ['list' => $query, 'noFtb' => $noFtb, 'name' => $name, 'department' => $department]
        );
    }

    public function approveFlowInFinal(Request $request){
        $arrayId = $request->arrayOfId;
        $currTime = Carbon::now()->format('d, M Y [H:i:s]');
        $pic = auth()->user()->name;
        $signature =Auth::user()->signature;
        foreach ($arrayId as $id) {
            $data = FlowInPart::find($id);
            $data->thirdApprovalPartIn = 'Approved';
            $data->ReasonThirdApprovalPartIn = NULL;
            $data->timeThirdApprovalPartIn = $currTime;
            $data->nameThirdApprovalPartIn = $pic;
            $data->signatureHead = $signature;
            $data->save();

            $history = new HistoryIn();
            $history->status = "Approved Final (HEAD)";
            $history->timeStatus = $currTime;
            $history->name = auth()->user()->name;
            $history->id_flowInPart = $id;
            $history->save();
        }

        $attributePart = FlowInPart::findOrFail($id);

        $namaRequester = $attributePart->nameRequester;
        $departmentRequester = $attributePart->departmentRequester;

        $email = User::where('role', 'master')
                ->where('departement', 'procurement')
                ->pluck('email')
                ->toArray();
        $emailString = implode(', ', $email);

        $mail = config('mail.from.address');

        $mail_data = [
            'fromEmail' => $mail,
            'fromName' => 'Sunter & ORF Warehouse (SINV)',
            'recipient' => $emailString,
            'subject' => 'Pengajuan Formulir Terima Barang',
            'body' => "$namaRequester dari Departemen $departmentRequester mengajukan dokumen Formulir Terima Barang(FTB). Yuk segera di approve :)",
        ];
        \Mail::send('email-template',$mail_data, function($message) use ($mail_data){
            $message->to($mail_data['recipient'])
                    ->from($mail_data['fromEmail'], $mail_data['fromName'])
                    ->subject($mail_data['subject']);
        });

        return redirect('/flowInFinalHead')->with('success', 'Berhasil Approve Satu Request');
    }
}
