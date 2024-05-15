<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FlowOutPart;
use App\Models\HistoryOut;
use App\Models\User;
use Carbon\Carbon;
use App\Models\Part;
use Illuminate\Support\Facades\DB;
use Romans\Filter\IntToRoman;
use Illuminate\Support\Facades\Auth;
use App\Models\AutoFKB;
class FlowOutPendingApproval extends Controller
{
    public function index()
    {
        $data = DB::table('flow_out_part')
        ->join('part', 'flow_out_part.idPart', '=', 'part.idPart')
        ->select(
            'part.namaPart',
            'part.satuanPart',
            'flow_out_part.dtStockPartOut',
            'flow_out_part.qtyStockPartOut',
            'flow_out_part.id_flowOutPart',
            'flow_out_part.noPart',
            'flow_out_part.firstApprovalPartOut',
            'flow_out_part.secondApprovalPartOut'
        )
        ->where('firstApprovalPartOut', '=', 'Waiting For Approval')
        ->where('firstApprovalPartOut', '=', 'Approved')
        ->orWhere('firstApprovalPartOut', '=', 'Revision')
        ->orWhere('firstApprovalPartOut', '=', 'Updated By User')
        ->orWhere('secondApprovalPartOut', '=', 'Waiting For Approval')
        ->orWhere('secondApprovalPartOut', '=', 'Revision')
        ->orWhere('secondApprovalPartOut', '=', 'Updated By User')
        ->orderBy('dtStockPartOut', 'desc')
        ->get();

        return view('ApprovalPages.flowOutPendingApproval', ['listPendingOut' => $data]);
    }

    public function showDetail($id)
    {
        $queryFindRecords = FlowOutPart::findOrFail($id);
        $queryFindPart = Part::find($queryFindRecords->idPart);
        $category = ucwords($queryFindPart->kategoriPart);
        return view('ApprovalPages.DetailItems.flowOutPending-detail', ['data' => $queryFindRecords, 'category' => $category, 'part' => $queryFindPart]);
    }

    public function approveDokumenOut($id)
    {
        $data = FlowOutPart::find($id);
        $data->firstApprovalPartOut = 'Approved';
        $data->ReasonFirstApprovalPartOut = NULL;
        $data->timeFirstApprovalPartOut = Carbon::now()->format('d, M Y [H:i:s]');
        $data->nameFirstApprovalPartOut = auth()->user()->name;
        $data->save();
        return redirect()->back()->with('success', 'Berhasil Approve Dokumen');
    }
    public function rejectDokumenOut($id)
    {
        $data = FlowOutPart::find($id);
        $time = Carbon::now()->format('d, M Y [H:i:s]');
        $user = auth()->user()->name;
        $data->firstApprovalPartOut = 'Reject';
        $data->secondApprovalPartOut = 'Reject';
        $data->thirdApprovalPartOut = 'Reject';
        $data->thirdApprovalDocsPartOut = 'Reject';
        $data->fourthApprovalPartOut = 'Reject';
        $data->timeFirstApprovalPartOut = $time;
        $data->timeSecondApprovalPartOut = $time;
        $data->timeThirdApprovalPartOut = $time;
        $data->timeFourthApprovalPartOut = $time;
        $data->nameFirstApprovalPartOut = $user;
        $data->nameSecondApprovalPartOut = $user;
        $data->nameThirdApprovalPartOut = $user;
        $data->nameFourthApprovalPartOut = $user;
        $data->save();
        return redirect()->back()->with('success', 'Berhasil Reject Satu Request');
    }

    public function showReasonFirstApproval($id)
    {
        $link = 'ApprovalPages.ReasonApprovalPages.reasonFirstApproval';
        $action = 'reasonsFirstApprovalOut';
        $nameReason = 'ReasonFirstApprovalPartOut';
        return view($link, ['id' => $id , 'action'=>$action, 'nameReason'=>$nameReason]);
    }
    public function postReasonFirstApproval(Request $request, $id)
    {
        $currTime = Carbon::now()->format('d, M Y [H:i:s]');
        $data = FlowOutPart::find($id);
        $data->firstApprovalPartOut = 'Revision';
        $data->timeFirstApprovalPartOut = Carbon::now()->format('d, M Y [H:i:s]');
        $data->nameFirstApprovalPartOut = auth()->user()->name;
        $data->ReasonFirstApprovalPartOut = $request->ReasonFirstApprovalPartOut;
        $data->save();
        $link = '/flowOutPending-detail/' . $id;

        $history = new HistoryOut();
        $history->status = "Revisi Dokumen";
        $history->timeStatus = $currTime;
        $history->reason = $request->ReasonFirstApprovalPartOut;
        $history->name = auth()->user()->name;
        $history->id_flowOutPart = $id;
        $history->save();

        return redirect()->to($link)->with('success', 'Berhasil Menambahkan Alasan Revisi');
    }

    public function approveFisikOut($id)
    {
        $data = FlowOutPart::find($id);
        $data->secondApprovalPartOut = 'Approved';
        $data->ReasonSecondApprovalPartOut = NULL;
        $data->timeSecondApprovalPartOut = Carbon::now()->format('d, M Y [H:i:s]');
        $data->nameSecondApprovalPartOut = auth()->user()->name;
        $data->save();
        return redirect()->back()->with('success', 'Berhasil Approve Fisik');
    }

    public function showReasonSecondApproval($id)
    {
        $link = 'ApprovalPages.ReasonApprovalPages.reasonSecondApproval';
        $action = 'reasonsSecondApprovalOut';
        $nameReason = 'ReasonSecondApprovalPartOut';
        return view($link, ['id' => $id, 'action' => $action, 'nameReason' => $nameReason]);
    }

    public function postReasonSecondApproval(Request $request, $id)
    {
        $currTime = Carbon::now()->format('d, M Y [H:i:s]');
        $data = FlowOutPart::find($id);
        $data->secondApprovalPartOut = 'Revision';
        $data->timeSecondApprovalPartOut = Carbon::now()->format('d, M Y [H:i:s]');
        $data->nameSecondApprovalPartOut = auth()->user()->name;
        $data->ReasonSecondApprovalPartOut = $request->ReasonSecondApprovalPartOut;
        $data->save();
        $link = '/flowOutPending-detail/' . $id;

        $history = new HistoryOut();
        $history->status = "Revisi Fisik";
        $history->timeStatus = $currTime;
        $history->reason = $request->ReasonSecondApprovalPartOut;
        $history->name = auth()->user()->name;
        $history->id_flowOutPart = $id;
        $history->save();

        return redirect()->to($link)->with('success', 'Berhasil Menambahkan Alasan Revisi');
    }


    // TODO:APPROVED OUT BASED ON DATE
    public function indexApprovalDate()
    {
        $query = DB::table('flow_out_part')
            ->join('part', 'flow_out_part.idPart','=','part.idPart')
            ->select(
                'flow_out_part.dtStockPartOut',
                'flow_out_part.nameRequester',
                'flow_out_part.departmentRequester',
                'part.lokasiPart',
                'part.kategoriMaterial',
            )
            ->whereNull('flow_out_part.noFkb')
            ->where(
                function ($query) {
                    $query->where('firstApprovalPartOut', '=', 'Waiting For Approval')
                    ->orWhere('firstApprovalPartOut', '=', 'Revision')
                    ->orWhere('firstApprovalPartOut', '=', 'Updated By User')
                    ->orWhere('thirdApprovalDocsPartOut', '=', 'Revision')
                    ->orWhere('thirdApprovalDocsPartOut', '=', 'Updated By User')
                    ->orWhere('part.kategoriPart', '=', 'scrap');
                }
            )
            ->orderBy('dtStockPartOut', 'desc')
            ->distinct()
            ->get();
        return view('ApprovalPages.ApprovalDates.flowOutDate', ['dataset' => $query]);
    }

    public function showForm($date, $name, $lokasi, $department,$material)
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
            'flow_out_part.thirdApprovalDocsPartOut',
            'flow_out_part.nameThirdApprovalDocsPartOut',
            'flow_out_part.timeThirdApprovalDocsPartOut',
            'flow_out_part.ReasonThirdApprovalDocsPartOut',
            'flow_out_part.nameRequester',
            'flow_out_part.filePhotoPartOut',
            'flow_out_part.filePO',
            'flow_out_part.fileBAST',

        )
            ->where(function ($query) {
                $query->where('flow_out_part.firstApprovalPartOut', '=', 'Approved')
                ->orWhere('flow_out_part.firstApprovalPartOut', '=', 'Waiting For Approval')
                ->orWhere('flow_out_part.firstApprovalPartOut', '=', 'Revision')
                ->orWhere('flow_out_part.firstApprovalPartOut', '=', 'Updated By User')
                ->orWhere('flow_out_part.timeThirdApprovalDocsPartOut', '=', 'Revision')
                ->orWhere('flow_out_part.timeThirdApprovalDocsPartOut', '=', 'Updated By User');
            })
            ->whereNull('flow_out_part.noFkb')
            ->where('flow_out_part.dtStockPartOut', '=', $date)
            ->where('flow_out_part.nameRequester', '=', $name)
            ->where('flow_out_part.departmentRequester', '=', $department)
            ->where('part.lokasiPart', '=', $lokasi)
            ->where('part.kategoriMaterial', '=', $material)
            ->get();

        return view(
            'ApprovalPages.ApprovalDates.showFormOut',
            ['list' => $query, 'date' => $date, 'name' => $name, 'lokasi' => $lokasi, 'department' => $department]
        );
    }

    public function approveAllOut(Request $request)
    {
        $arrayId = $request->arrayOfId;
        $currTime = Carbon::now()->format('d, M Y [H:i:s]');
        $pic = auth()->user()->name;

        foreach ($arrayId as $id) {
            $data = FlowOutPart::find($id);
            $data->firstApprovalPartOut = 'Approved';
            $data->ReasonFirstApprovalPartOut = NULL;
            $data->timeFirstApprovalPartOut = $currTime;
            $data->nameFirstApprovalPartOut = $pic;
            $data->thirdApprovalDocsPartOut = 'Waiting For Approval';
            $data->timeThirdApprovalDocsPartOut = NULL;
            $data->nameThirdApprovalDocsPartOut = NULL;
            $data->ReasonThirdApprovalDocsPartOut = NULL;
            $data->save();

            // HISTORY
            $history = new HistoryOut();
            $history->status = "Approved Dokumen (ADMIN)";
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

        return redirect('/flowOutPendingApprovalDate')->with('success', 'Berhasil Approve Satu Request');
    }

    public function indexApprovalFisik()
    {
        $query = DB::table('flow_out_part')
                ->join('part', 'flow_out_part.idPart', '=', 'part.idPart')
                ->select(
                    'flow_out_part.dtStockPartOut',
                    'flow_out_part.nameRequester',
                    'flow_out_part.departmentRequester',
                    'part.lokasiPart',
                    'part.kategoriMaterial',
                )
                ->whereNull('flow_out_part.noFkb')
                ->where('thirdApprovalDocsPartOut', '=', 'Approved')
                ->orderBy('dtStockPartOut', 'desc')
                ->distinct()
                ->get();
        return view('ApprovalPages.ApprovalDates.flowOutFisik', ['dataset' => $query]);
    }

    public function showFormFisik($date, $name, $lokasi, $department,$material)
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
                    'flow_out_part.thirdApprovalDocsPartOut',
                    'flow_out_part.nameThirdApprovalDocsPartOut',
                    'flow_out_part.timeThirdApprovalDocsPartOut',
                    'flow_out_part.ReasonThirdApprovalDocsPartOut',
                    'flow_out_part.nameRequester',
                    'flow_out_part.filePhotoPartOut',
                    'flow_out_part.filePO',
                    'flow_out_part.fileBAST',
                )
                    ->whereNull('flow_out_part.noFkb')
                    ->where('flow_out_part.thirdApprovalDocsPartOut', '=', 'Approved')
                    ->where('flow_out_part.dtStockPartOut', '=', $date)
                    ->where('flow_out_part.nameRequester', '=', $name)
                    ->where('flow_out_part.departmentRequester', '=', $department)
                    ->where('part.lokasiPart', '=', $lokasi)
                    ->where('part.kategoriMaterial', '=', $material)
                    ->get();


        return view(
            'ApprovalPages.ApprovalDates.showFormOut',
            ['list' => $query, 'date' => $date, 'name' => $name, 'lokasi' => $lokasi, 'department' => $department]
        );
    }

    public function approveFisikAllOut(Request $request)
    {
        $arrayId = $request->arrayOfId;
        $countFkb = DB::table('auto_fkb')
                    ->select('countNoSuratFkb')
                    ->latest()
                    ->first();

        $pic = auth()->user()->name;
        $currTime = Carbon::now()->format('d, M Y [H:i:s]');
        $createdAt = \Carbon\Carbon::now();
        $filter = new IntToRoman();
        $month = $filter->filter(date('n'));
        $year = date("Y");

        $signature = Auth::user()->signature;

        if (empty($countFkb)) {
            $no = 27;
            $autoFkb = new AutoFKB;
            $autoFkb->countNoSuratFkb = $no;
            $autoFkb->created_at = $createdAt;
            $autoFkb->save();
            $format_no = sprintf('%04d', $no);
            $fkb = "No." . $format_no . "/NR" . "/C220" . "/FKB" . "/" . $month . "/" . $year;

            foreach ($arrayId as $id) {
                $data = FlowOutPart::find($id);
                $data->noFkb = $fkb;
                $data->secondApprovalPartOut = 'Approved';
                $data->timeSecondApprovalPartOut = $currTime;
                $data->nameSecondApprovalPartOut = $pic;
                $data->ReasonSecondApprovalPartOut = NULL;
                $data->dtStockPartApprovedOut = date('Y-m-d');
                $data->signatureAdmin = $signature;
                $data->save();

                $history = new HistoryOut();
                $history->status = "Approved Fisik (ADMIN)";
                $history->timeStatus = $currTime;
                $history->name = auth()->user()->name;
                $history->id_flowOutPart = $id;
                $history->save();
            }
        } 
        else 
        {

            $no = $countFkb->countNoSuratFkb + 1;

            $autoFkb = new AutoFKB;
            $autoFkb->countNoSuratFkb = $no;
            $autoFkb->created_at = $createdAt;
            $autoFkb->save();

            $format_no = sprintf('%04d', $no);
            $fkb = "No." . $format_no . "/NR" . "/C220" . "/FKB" . "/" . $month . "/" . $year;

            foreach ($arrayId as $id) {
                $data = FlowOutPart::find($id);
                $data->noFkb = $fkb;
                $data->secondApprovalPartOut = 'Approved';
                $data->timeSecondApprovalPartOut = $currTime;
                $data->nameSecondApprovalPartOut = $pic;
                $data->ReasonSecondApprovalPartOut = NULL;
                $data->dtStockPartApprovedOut = date('Y-m-d');
                $data->signatureAdmin = $signature;
                $data->save();

                $history = new HistoryOut();
                $history->status = "Approved Fisik (ADMIN)";
                $history->timeStatus = $currTime;
                $history->name = auth()->user()->name;
                $history->id_flowOutPart = $id;
                $history->save();
            }
        }

        $attributePart = FlowOutPart::findOrFail($id);

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
            'subject' => 'Pengajuan Formulir Keluar Barang',
            'body' => "$namaRequester dari Departemen $departmentRequester mengajukan dokumen Formulir Keluar Barang(FKB). Yuk segera di approve :)",
        ];
        // \Mail::send('email-template',$mail_data, function($message) use ($mail_data){
        //     $message->to($mail_data['recipient'])
        //             ->from($mail_data['fromEmail'], $mail_data['fromName'])
        //             ->subject($mail_data['subject']);
        // });

        return redirect('/flowOutPendingApprovalFisik')->with('success', 'Berhasil Approved Satu Request');
    }
}
