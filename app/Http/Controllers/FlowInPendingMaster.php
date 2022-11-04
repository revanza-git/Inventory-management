<?php

namespace App\Http\Controllers;

use App\Models\AutoFTB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\FlowInPart;
use App\Models\HistoryIn;
use Romans\Filter\IntToRoman;
use Illuminate\Support\Facades\Auth;


class FlowInPendingMaster extends Controller
{
    public function index()
    {
        $query = DB::table('flow_in_part')
        ->join('part', 'flow_in_part.idPart', '=', 'part.idPart')
        ->select(
            'flow_in_part.nameRequester',
            'flow_in_part.departmentRequester',
            'flow_in_part.noFtb'
        )
        ->where('flow_in_part.thirdApprovalPartIn', '=', 'Approved')
        ->where('flow_in_part.fourthApprovalPartIn', '=', 'Waiting For Approval')
        ->whereNotNull('flow_in_part.noFtb')
        ->distinct()
        ->get();
         
        return view('ApprovalMasterPages.flowInPendingMaster', ['dataset' => $query]);
    }

    public function showAllPendingIn(Request $request)
    {

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

    public function approveAllIn(Request $request){
        $arrayId = $request->arrayOfId;
        $currTime = Carbon::now()->format('d, M Y [H:i:s]');
        $pic = auth()->user()->name;
        $signature = Auth::user()->signature;
        foreach ($arrayId as $id) {
            $data = FlowInPart::find($id);
            $data->fourthApprovalPartIn = 'Approved';
            $data->ReasonFourthApprovalPartIn = NULL;
            $data->timeFourthApprovalPartIn = $currTime;
            $data->nameFourthApprovalPartIn = $pic;
            $data->signatureMaster = $signature;
            $data->save();

            $history = new HistoryIn();
            $history->status = "Approved Final (Head Of Procurement)";
            $history->timeStatus = $currTime;
            $history->name = auth()->user()->name;
            $history->id_flowInPart = $id;
            $history->save();
        }
        return redirect('/flowInPendingMaster')->with('success', 'Berhasil Approve Satu Request');
    }

   



}
