<?php

namespace App\Http\Controllers;

use App\Models\AutoFKB;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\FlowOutPart;
use App\Models\HistoryOut;
use Romans\Filter\IntToRoman;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class FlowOutPendingMaster extends Controller
{
    public function index()
    {
        $query = DB::table('flow_out_part')
        ->join('part', 'flow_out_part.idPart', '=', 'part.idPart')
        ->select(
            'flow_out_part.nameRequester',
            'flow_out_part.departmentRequester',
            'flow_out_part.noFkb'
        )
        ->where('flow_out_part.thirdApprovalPartOut', '=', 'Waiting For Approval')
        ->where('flow_out_part.fourthApprovalPartOut', '=', 'Waiting For Approval')
        ->whereNotNull('flow_out_part.noFkb')
        ->distinct()
        ->get();
      
        return view('ApprovalMasterPages.flowOutPendingMaster', ['dataset' => $query]);
    }

    public function showAllPendingOut(Request $request)
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
        return view(
            'ApprovalHeadPages.detailFlowOutFinal',
            ['list' => $query, 'noFkb' => $noFkb, 'name' => $name, 'department' => $department]
        );
    }

    public function approveAllOut(Request $request)
    {
        $arrayId = $request->arrayOfId;
        $currTime = Carbon::now()->format('d, M Y [H:i:s]');
        $pic = auth()->user()->name;
        $signature = Auth::user()->signature;
        foreach ($arrayId as $id) {
            $data = FlowOutPart::find($id);
            $data->fourthApprovalPartOut = 'Approved';
            $data->ReasonFourthApprovalPartOut = NULL;
            $data->timeFourthApprovalPartOut = $currTime;
            $data->nameFourthApprovalPartOut = $pic;
            $data->signatureMaster = $signature;
            $data->save();

            $history = new HistoryOut();
            $history->status = "Approved Final (Head Of Procurement)";
            $history->timeStatus = $currTime;
            $history->name = auth()->user()->name;
            $history->id_flowOutPart = $id;
            $history->save();
        }

        $attributePart = FlowOutPart::findOrFail($id);

        $namaRequester = $attributePart->nameRequester;
        $departmentRequester = $attributePart->departmentRequester;

        $email = User::where('role', 'head')
                ->where('departement', $departmentRequester)
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

        return redirect('/flowOutPendingMaster')->with('success', 'Berhasil Approve Satu Request');
    }


    
}
