<?php

namespace App\Http\Controllers;

use App\Models\HistoryOut;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\FlowOutPart;

class FlowOutPendingHead extends Controller
{
    public function index()
    {

        if (Auth::user()->departement == 'reliability') {
            $query = DB::table('flow_out_part')
            ->join('part', 'flow_out_part.idPart', '=', 'part.idPart')
            ->select(
                'flow_out_part.dtStockPartOut',
                'flow_out_part.nameRequester',
                'flow_out_part.departmentRequester',
                'part.lokasiPart',
                'part.kategoriMaterial'
            )
                ->where('flow_out_part.firstApprovalPartOut', '=', 'Approved')
                ->where('flow_out_part.thirdApprovalDocsPartOut', '=', 'Waiting For Approval')
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
                ->orderBy('flow_out_part.dtStockPartOut', 'desc')
                ->distinct()
                ->get();
        }
        if (Auth::user()->departement == 'layum') {
            $query = DB::table('flow_out_part')
            ->join('part', 'flow_out_part.idPart', '=', 'part.idPart')
            ->select(
                'flow_out_part.dtStockPartOut',
                'flow_out_part.nameRequester',
                'flow_out_part.departmentRequester',
                'part.lokasiPart',
                'part.kategoriMaterial'
            )
                ->where('flow_out_part.firstApprovalPartOut', '=', 'Approved')
                ->where('flow_out_part.thirdApprovalDocsPartOut', '=', 'Waiting For Approval')
                ->where(function ($query) {
                    $query->where('part.kategoriPart', '=', 'tiyum')
                    ->orWhere('part.kategoriPart', '=', 'scrayum');
                })
                ->whereNull('flow_out_part.noFkb')
                ->orderBy('flow_out_part.dtStockPartOut', 'desc')
                ->distinct()
                ->get();
        }
        if (Auth::user()->departement == 'technology') {
            $query = DB::table('flow_out_part')
            ->join('part', 'flow_out_part.idPart', '=', 'part.idPart')
            ->select(
                'flow_out_part.dtStockPartOut',
                'flow_out_part.nameRequester',
                'flow_out_part.departmentRequester',
                'part.lokasiPart',
                'part.kategoriMaterial'
            )
                ->where('flow_out_part.firstApprovalPartOut', '=', 'Approved')
                ->where('flow_out_part.thirdApprovalDocsPartOut', '=', 'Waiting For Approval')
                ->whereNull('flow_out_part.noFkb')
                ->where('part.kategoriPart', '=', 'technology')
                ->orderBy('flow_out_part.dtStockPartOut', 'desc')
                ->distinct()
                ->get();
        }
        if (Auth::user()->departement == 'sekper') {
            $query = DB::table('flow_out_part')
            ->join('part', 'flow_out_part.idPart', '=', 'part.idPart')
            ->select(
                'flow_out_part.dtStockPartOut',
                'flow_out_part.nameRequester',
                'flow_out_part.departmentRequester',
                'part.lokasiPart',
                'part.kategoriMaterial'
            )
                ->where('flow_out_part.firstApprovalPartOut', '=', 'Approved')
                ->where('flow_out_part.thirdApprovalDocsPartOut', '=', 'Waiting For Approval')
                ->whereNull('flow_out_part.noFkb')
                ->where('part.kategoriPart', '=', 'sekper')
                ->orderBy('flow_out_part.dtStockPartOut', 'desc')
                ->distinct()
                ->get();
        }

        if (Auth::user()->departement == 'hsse') {
            $query = DB::table('flow_out_part')
            ->join('part', 'flow_out_part.idPart', '=', 'part.idPart')
            ->select(
                'flow_out_part.dtStockPartOut',
                'flow_out_part.nameRequester',
                'flow_out_part.departmentRequester',
                'part.lokasiPart',
                'part.kategoriMaterial'
            )
                ->where('flow_out_part.firstApprovalPartOut', '=', 'Approved')
                ->where('flow_out_part.thirdApprovalDocsPartOut', '=', 'Waiting For Approval')
                ->whereNull('flow_out_part.noFkb')
                ->where('part.kategoriPart', '=', 'hsse')
                ->orderBy('flow_out_part.dtStockPartOut', 'desc')
                ->distinct()
                ->get();
        }


        if (Auth::user()->departement == 'migas') {
            $query = DB::table('flow_out_part')
            ->join('part', 'flow_out_part.idPart', '=', 'part.idPart')
            ->select(
                'flow_out_part.dtStockPartOut',
                'flow_out_part.nameRequester',
                'flow_out_part.departmentRequester',
                'part.lokasiPart',
                'part.kategoriMaterial'
            )
                ->where('flow_out_part.firstApprovalPartOut', '=', 'Approved')
                ->where('flow_out_part.thirdApprovalDocsPartOut', '=', 'Waiting For Approval')
                ->whereNull('flow_out_part.noFkb')
                ->where('part.kategoriPart', '=', 'gasorf')
                ->orderBy('flow_out_part.dtStockPartOut', 'desc')
                ->distinct()
                ->get();
        }

        if (Auth::user()->departement == 'transportasi') {
            $query = DB::table('flow_out_part')
            ->join('part', 'flow_out_part.idPart', '=', 'part.idPart')
            ->select(
                'flow_out_part.dtStockPartOut',
                'flow_out_part.nameRequester',
                'flow_out_part.departmentRequester',
                'part.lokasiPart',
                'part.kategoriMaterial'
            )
                ->where('flow_out_part.firstApprovalPartOut', '=', 'Approved')
                ->where('flow_out_part.thirdApprovalDocsPartOut', '=', 'Waiting For Approval')
                ->whereNull('flow_out_part.noFkb')
                ->where('part.kategoriPart', '=', 'transportasi')
                ->orderBy('flow_out_part.dtStockPartOut', 'desc')
                ->distinct()
                ->get();
        }

        if (Auth::user()->departement == 'bisnis') {
            $query = DB::table('flow_out_part')
            ->join('part', 'flow_out_part.idPart', '=', 'part.idPart')
            ->select(
                'flow_out_part.dtStockPartOut',
                'flow_out_part.nameRequester',
                'flow_out_part.departmentRequester',
                'part.lokasiPart',
                'part.kategoriMaterial'
            )
                ->where('flow_out_part.firstApprovalPartOut', '=', 'Approved')
                ->where('flow_out_part.thirdApprovalDocsPartOut', '=', 'Waiting For Approval')
                ->whereNull('flow_out_part.noFkb')
                ->where('part.kategoriPart', '=', 'bisnis')
                ->orderBy('flow_out_part.dtStockPartOut', 'desc')
                ->distinct()
                ->get();
        }
        // dd($query);
        return view('ApprovalHeadPages.flowoutPendingHead', ['dataset' => $query]);
    }

    public function showAllPendingOut($date, $name, $lokasi, $department,$material)
    {

        $query = DB::table('flow_out_part')
            ->join('part', 'flow_out_part.idPart', '=', 'part.idPart')
            ->select(
                'flow_out_part.id_flowOutPart',
                'flow_out_part.noPart',
                'part.namaPart',
                'part.size',
                'flow_out_part.qtyStockPartOut',
                'part.satuanPart',
                'flow_out_part.priceStockPartOut',
                'flow_out_part.needsStockPartOut',
                'flow_out_part.firstApprovalPartOut',
                'flow_out_part.timeFirstApprovalPartOut',
                'flow_out_part.secondApprovalPartOut',
                'flow_out_part.timeSecondApprovalPartOut',
                'flow_out_part.filePhotoPartOut',
                'flow_out_part.filePO',
                'flow_out_part.fileBAST',
            )
            ->where('flow_out_part.firstApprovalPartOut', '=', 'Approved')
            ->where('flow_out_part.thirdApprovalDocsPartOut', '=', 'Waiting For Approval')
            ->whereNull('flow_out_part.noFkb')
            ->where('flow_out_part.dtStockPartOut', '=', $date)
            ->where('flow_out_part.nameRequester', '=', $name)
            ->where('part.lokasiPart', '=', $lokasi)
            ->where('part.kategoriMaterial', '=', $material)
            ->get();

        return view('ApprovalHeadPages.approveOutHead', ['list' => $query, 'date' => $date, 'name' => $name, 'lokasi' => $lokasi, 'department' => $department]);
    }

    public function approveAllOut(Request $request)
    {
        $arrayId = $request->arrayOfId;
        $currTime = Carbon::now()->format('d, M Y [H:i:s]');
        $pic = auth()->user()->name;
        // $signature =Auth::user()->signature;
        foreach ($arrayId as $id) {
            $data = FlowOutPart::find($id);
            $data->thirdApprovalDocsPartOut = 'Approved';
            $data->ReasonThirdApprovalDocsPartOut = NULL;
            $data->timeThirdApprovalDocsPartOut = $currTime;
            $data->nameThirdApprovalDocsPartOut = $pic;
            $data->save();

            $history = new HistoryOut();
            $history->status = "Approve Dokumen (HEAD)";
            $history->timeStatus = $currTime;
            $history->name = auth()->user()->name;
            $history->id_flowOutPart = $id;
            $history->save();
        }

        $attributePart = FlowOutPart::findOrFail($id);

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
            'subject' => 'Pengajuan Formulir Keluar Barang',
            'body' => "$namaRequester dari Departemen $departmentRequester mengajukan dokumen Formulir Keluar Barang(FKB). Yuk segera di approve :)",
        ];
        // \Mail::send('email-template',$mail_data, function($message) use ($mail_data){
        //     $message->to($mail_data['recipient'])
        //             ->from($mail_data['fromEmail'], $mail_data['fromName'])
        //             ->subject($mail_data['subject']);
        // });

        return redirect('/flowOutPendingHead')->with('success', 'Berhasil Approve Satu Request');
    }

    public function revisionAllOut(Request $request)
    {

        $arrayId = $request->arrayOfId;
        $currTime = Carbon::now()->format('d, M Y [H:i:s]');
        $pic = auth()->user()->name;

        foreach ($arrayId as $id) {
            $data = FlowOutPart::find($id);
            $data->thirdApprovalDocsPartOut = 'Revision';
            $data->ReasonThirdApprovalDocsPartOut = $request->ReasonThirdApprovalDocsPartOut;
            $data->timeThirdApprovalDocsPartOut = $currTime;
            $data->nameThirdApprovalDocsPartOut = $pic;
            $data->save();

            $history = new HistoryOut();
            $history->status = "Revisi Dokumen (HEAD)";
            $history->timeStatus = $currTime;
            $history->name = auth()->user()->name;
            $history->reason = $request->ReasonThirdApprovalDocsPartOut;
            $history->id_flowOutPart = $id;
            $history->save();
        }
        return redirect('/flowOutPendingHead')->with('success', 'Berhasil Revisi Dokumen Satu Request');
    }

    public function indexFinal()
    {

        if (Auth::user()->departement == 'reliability') {
            $query = DB::table('flow_out_part')
            ->join('part', 'flow_out_part.idPart', '=', 'part.idPart')
            ->select(
                'flow_out_part.nameRequester',
                'flow_out_part.departmentRequester',
                'flow_out_part.noFkb'
            )
                ->where('flow_out_part.thirdApprovalPartOut', '=', 'Waiting For Approval')
                ->where('flow_out_part.fourthApprovalPartOut', '=', 'Approved')
                ->whereNotNull('flow_out_part.noFkb')
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
            $query = DB::table('flow_out_part')
            ->join('part', 'flow_out_part.idPart', '=', 'part.idPart')
            ->select(
                'flow_out_part.nameRequester',
                'flow_out_part.departmentRequester',
                'flow_out_part.noFkb'
            )
                ->where('flow_out_part.thirdApprovalPartOut', '=', 'Waiting For Approval')
                ->where('flow_out_part.fourthApprovalPartOut', '=', 'Approved')
                ->whereNotNull('flow_out_part.noFkb')
                ->where(function ($query) {
                    $query->where('part.kategoriPart', '=', 'tiyum')
                    ->orWhere('part.kategoriPart', '=', 'scrayum');
                })
                ->distinct()
                ->get();
        }
        if (Auth::user()->departement == 'technology') {
            $query = DB::table('flow_out_part')
            ->join('part', 'flow_out_part.idPart', '=', 'part.idPart')
            ->select(
                'flow_out_part.nameRequester',
                'flow_out_part.departmentRequester',
                'flow_out_part.noFkb'
            )
                ->where('flow_out_part.thirdApprovalPartOut', '=', 'Waiting For Approval')
                ->where('flow_out_part.fourthApprovalPartOut', '=', 'Approved')
                ->whereNotNull('flow_out_part.noFkb')
                ->where('part.kategoriPart', '=', 'technology')
                ->distinct()
                ->get();
        }
        if (Auth::user()->departement == 'sekper') {
            $query = DB::table('flow_out_part')
            ->join('part', 'flow_out_part.idPart', '=', 'part.idPart')
            ->select(
                'flow_out_part.nameRequester',
                'flow_out_part.departmentRequester',
                'flow_out_part.noFkb'
            )
                ->where('flow_out_part.thirdApprovalPartOut', '=', 'Waiting For Approval')
                ->where('flow_out_part.fourthApprovalPartOut', '=', 'Approved')
                ->whereNotNull('flow_out_part.noFkb')
                ->where('part.kategoriPart', '=', 'sekper')
                ->distinct()
                ->get();
        }

        if (Auth::user()->departement == 'hsse') {
            $query = DB::table('flow_out_part')
            ->join('part', 'flow_out_part.idPart', '=', 'part.idPart')
            ->select(
                'flow_out_part.nameRequester',
                'flow_out_part.departmentRequester',
                'flow_out_part.noFkb'
            )
                ->where('flow_out_part.thirdApprovalPartOut', '=', 'Waiting For Approval')
                ->where('flow_out_part.fourthApprovalPartOut', '=', 'Approved')
                ->whereNotNull('flow_out_part.noFkb')
                ->where('part.kategoriPart', '=', 'hsse')
                ->distinct()
                ->get();
        }

        if (Auth::user()->departement == 'migas') {
            $query = DB::table('flow_out_part')
            ->join('part', 'flow_out_part.idPart', '=', 'part.idPart')
            ->select(
                'flow_out_part.nameRequester',
                'flow_out_part.departmentRequester',
                'flow_out_part.noFkb'
            )
                ->where('flow_out_part.thirdApprovalPartOut', '=', 'Waiting For Approval')
                ->where('flow_out_part.fourthApprovalPartOut', '=', 'Approved')
                ->whereNotNull('flow_out_part.noFkb')
                ->where('part.kategoriPart', '=', 'gasorf')
                ->distinct()
                ->get();
        }

        if (Auth::user()->departement == 'transportasi') {
            $query = DB::table('flow_out_part')
            ->join('part', 'flow_out_part.idPart', '=', 'part.idPart')
            ->select(
                'flow_out_part.nameRequester',
                'flow_out_part.departmentRequester',
                'flow_out_part.noFkb'
            )
                ->where('flow_out_part.thirdApprovalPartOut', '=', 'Waiting For Approval')
                ->where('flow_out_part.fourthApprovalPartOut', '=', 'Approved')
                ->whereNotNull('flow_out_part.noFkb')
                ->where('part.kategoriPart', '=', 'transportasi')
                ->distinct()
                ->get();
        }

        if (Auth::user()->departement == 'bisnis') {
            $query = DB::table('flow_out_part')
            ->join('part', 'flow_out_part.idPart', '=', 'part.idPart')
            ->select(
                'flow_out_part.nameRequester',
                'flow_out_part.departmentRequester',
                'flow_out_part.noFkb'
            )
                ->where('flow_out_part.thirdApprovalPartOut', '=', 'Waiting For Approval')
                ->where('flow_out_part.fourthApprovalPartOut', '=', 'Approved')
                ->whereNotNull('flow_out_part.noFkb')
                ->where('part.kategoriPart', '=', 'bisnis')
                ->distinct()
                ->get();
        }

        
        // dd($query);
        return view('ApprovalHeadPages.flowOutFinalHead', ['dataset' => $query]);
    }

    public function showDetailFinalFlowOut(Request $request)
    {   
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
                'part.kategoriPart',
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
            )
            ->where('flow_out_part.noFkb', '=', $noFkb)
            ->get();
        // dd($query);
        return view(
            'ApprovalHeadPages.detailFlowOutFinal',
            ['list' => $query, 'noFkb' => $noFkb, 'name' => $name, 'department' => $department]
        );
    }

    public function approveFlowOutFinal(Request $request)
    {
        $arrayId = $request->arrayOfId;
        $currTime = Carbon::now()->format('d, M Y [H:i:s]');
        $pic = auth()->user()->name;
        $signature = Auth::user()->signature;
        foreach ($arrayId as $id) {
            $data = FlowOutPart::find($id);
            $data->thirdApprovalPartOut = 'Approved';
            $data->ReasonThirdApprovalPartOut = NULL;
            $data->timeThirdApprovalPartOut = $currTime;
            $data->nameThirdApprovalPartOut = $pic;
            $data->signatureHead = $signature;
            $data->save();

            $history = new HistoryOut();
            $history->status = "Approved Final (HEAD)";
            $history->timeStatus = $currTime;
            $history->name = auth()->user()->name;
            $history->id_flowOutPart = $id;
            $history->save();
        }

        $attributePart = FlowOutPart::findOrFail($id);

        $namaRequester = $attributePart->nameRequester;
        $departmentRequester = $attributePart->departmentRequester;

        $email = User::where('name', $namaRequester)
                ->pluck('email')
                ->toArray();
        $emailString = implode(', ', $email);

        $mail = config('mail.from.address');

        $mail_data = [
            'fromEmail' => $mail,
            'fromName' => 'Sunter & ORF Warehouse (SINV)',
            'recipient' => $emailString,
            'subject' => 'Pengajuan Formulir Keluar Barang',
            'body' => "Pengajuan Formulir Keluar Barang-mu sudah selesai di approve. Silakan cek web SINV untuk melihat detailnya",
        ];
        \Mail::send('email-template',$mail_data, function($message) use ($mail_data){
            $message->to($mail_data['recipient'])
                    ->from($mail_data['fromEmail'], $mail_data['fromName'])
                    ->subject($mail_data['subject']);
        });

        return redirect('/flowOutFinalHead')->with('success', 'Berhasil Approve Satu Request');
    }
}
