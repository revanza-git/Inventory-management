<?php

namespace App\Http\Controllers;

use App\Models\FlowInPart;
use App\Models\HistoryIn;
use App\Models\Part;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\AutoFTB;
use Romans\Filter\IntToRoman;
use Illuminate\Support\Facades\Auth;
class FlowInPendingApproval extends Controller
{
    public function index(){
        $data = DB::table('flow_in_part')
                ->join('part', 'flow_in_part.idPart', '=', 'part.idPart')
                ->select('part.namaPart', 'part.satuanPart', 'flow_in_part.dtStockPartIn',
                'flow_in_part.qtyStockPartIn', 'flow_in_part.id_flowInPart',
                'flow_in_part.noPart', 'flow_in_part.firstApprovalPartIn',
                'flow_in_part.secondApprovalPartIn')
                ->where('firstApprovalPartIn', '=', 'Waiting For Approval')
                ->where('firstApprovalPartIn', '=', 'Approved')
                ->orWhere('firstApprovalPartIn', '=', 'Revision')
                ->orWhere('firstApprovalPartIn', '=', 'Updated By User')
                ->orWhere('secondApprovalPartIn', '=', 'Waiting For Approval')
                ->orWhere('secondApprovalPartIn', '=', 'Revision')
                ->orWhere('secondApprovalPartIn', '=', 'Updated By User')
                ->orderBy('dtStockPartIn','desc')
                ->get();
        
        return view('ApprovalPages.flowInPendingApproval',['listPendingIn' => $data]);
    }

    public function showDetail($id){
        $queryFindRecords = FlowInPart::findOrFail($id);
        $queryFindPart = Part::find($queryFindRecords->idPart);
        $category = ucwords($queryFindPart->kategoriPart);
        return view('ApprovalPages.DetailItems.flowInPending-detail',['data'=>$queryFindRecords,'category'=>$category,'part'=>$queryFindPart]);
    }

    public function approveDokumenIn($id){
        $data= FlowInPart::find($id);
        $data->firstApprovalPartIn = 'Approved';
        $data->ReasonFirstApprovalPartIn = NULL;
        $data->timeFirstApprovalPartIn =Carbon::now()->format('d, M Y [H:i:s]');
        $data->nameFirstApprovalPartIn = auth()->user()->name;
        $data->save();
        return redirect()->back()->with('success', 'Berhasil Approve Dokumen');
    }
    public function approveFisikIn($id)
    {
        $data = FlowInPart::find($id);
        $data->secondApprovalPartIn = 'Approved';
        $data->ReasonSecondApprovalPartIn = NULL;
        $data->timeSecondApprovalPartIn = Carbon::now()->format('d, M Y [H:i:s]');
        $data->nameSecondApprovalPartIn = auth()->user()->name;
        $data->save();
        return redirect()->back()->with('success', 'Berhasil Approve Fisik');
    }


    public function rejectDokumenIn($id){
        $data = FlowInPart::find($id);
        $time = Carbon::now()->format('d, M Y [H:i:s]');
        $user = auth()->user()->name;
        $data->firstApprovalPartIn = 'Reject';
        $data->secondApprovalPartIn = 'Reject';
        $data->thirdApprovalPartIn = 'Reject';
        $data->thirdApprovalDocsPartIn = 'Reject';
        $data->fourthApprovalPartIn = 'Reject';
        $data->timeFirstApprovalPartIn = $time;
        $data->timeSecondApprovalPartIn = $time;
        $data->timeThirdApprovalPartIn = $time;
        $data->timeFourthApprovalPartIn = $time;
        $data->nameFirstApprovalPartIn = $user;
        $data->nameSecondApprovalPartIn = $user;
        $data->nameThirdApprovalPartIn = $user;
        $data->nameFourthApprovalPartIn = $user;
        $data->save();
        return redirect()->back()->with('success', 'Berhasil Reject Satu Request');
    }

    

    public function showReasonFirstApproval($id){
        $link = 'ApprovalPages.ReasonApprovalPages.reasonFirstApproval';
        $action = 'reasonsFirstApprovalIn';
        $nameReason = 'ReasonFirstApprovalPartIn';
        return view ($link,['id' => $id , 'action'=>$action , 'nameReason' =>$nameReason]);
    }
    public function showReasonSecondApproval($id)
    {
        $link = 'ApprovalPages.ReasonApprovalPages.reasonSecondApproval';
        $action = 'reasonsSecondApprovalIn';
        $nameReason = 'ReasonSecondApprovalPartIn';
        return view($link, ['id' => $id , 'action' => $action , 'nameReason' =>$nameReason]);
    }
    public function postReasonFirstApproval(Request $request, $id){
        $currTime = Carbon::now()->format('d, M Y [H:i:s]');
        $data = FlowInPart::find($id);
        $data->firstApprovalPartIn = 'Revision';
        $data->timeFirstApprovalPartIn = $currTime;
        $data->nameFirstApprovalPartIn = auth()->user()->name;
        $data->ReasonFirstApprovalPartIn = $request->ReasonFirstApprovalPartIn;
        $data->save();
        $link = '/flowInPending-detail/'. $id;

          // HISTORY IN 
        
        $history = new HistoryIn();
        $history->status = "Revisi Dokumen";
        $history->timeStatus = $currTime;
        $history->reason = $request->ReasonFirstApprovalPartIn;
        $history->name = auth()->user()->name;
        $history->id_flowInPart = $id;
        $history->save();
        
        return redirect()->to($link)->with('success', 'Berhasil Menambahkan Alasan Revisi');
        
    }
    public function postReasonSecondApproval(Request $request, $id)
    {
        $currTime = Carbon::now()->format('d, M Y [H:i:s]');
        $data = FlowInPart::find($id);
        $data->secondApprovalPartIn = 'Revision';
        $data->timeSecondApprovalPartIn = Carbon::now()->format('d, M Y [H:i:s]');
        $data->nameSecondApprovalPartIn = auth()->user()->name;
        $data->ReasonSecondApprovalPartIn = $request->ReasonSecondApprovalPartIn;
        $data->save();
        $link = '/flowInPending-detail/' . $id;

        // HISTORY IN 

        $history = new HistoryIn();
        $history->status = "Revisi Fisik";
        $history->timeStatus = $currTime;
        $history->reason =$request->ReasonSecondApprovalPartIn;
        $history->name = auth()->user()->name;
        $history->id_flowInPart = $id;
        $history->save();

        return redirect()->to($link)->with('success', 'Berhasil Menambahkan Alasan Revisi');
    }


    // TODO:APPROVED IN BASED ON DATE
    public function indexApprovalDate(){
        $query = DB::table('flow_in_part')
        ->join('part', 'flow_in_part.idPart', '=', 'part.idPart')
        ->select(
            'flow_in_part.dtStockPartIn',
            'flow_in_part.nameRequester',
            'flow_in_part.departmentRequester',
            'part.lokasiPart',
            'part.kategoriMaterial',
        )
        ->whereNull('flow_in_part.noFtb')
        ->where(
            function ($query) {
                $query->where('firstApprovalPartIn', '=', 'Waiting For Approval')
                    ->orWhere('firstApprovalPartIn', '=', 'Revision')
                    ->orWhere('firstApprovalPartIn', '=', 'Updated By User')
                    ->orWhere('thirdApprovalDocsPartIn', '=', 'Revision')
                    ->orWhere('thirdApprovalDocsPartIn', '=', 'Updated By User')
                    ->orWhere('part.kategoriPart', '=', 'scrap');
            }
        )
        ->orderBy('dtStockPartIn', 'desc')
        ->distinct()
        ->get();
        return view('ApprovalPages.ApprovalDates.flowInDate', ['dataset' => $query]);
    }

    public function showForm($date, $name, $lokasi,$department,$material){
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
            'flow_in_part.thirdApprovalDocsPartIn',
            'flow_in_part.nameThirdApprovalDocsPartIn',
            'flow_in_part.timeThirdApprovalDocsPartIn',
            'flow_in_part.ReasonThirdApprovalDocsPartIn',
            'flow_in_part.nameRequester',
            'flow_in_part.filePhotoPartIn',
            'flow_in_part.filePO',
            'flow_in_part.fileBAST',
            
        )
        ->where(function ($query) {
            $query->where('flow_in_part.firstApprovalPartIn', '=', 'Approved')
            ->orWhere('flow_in_part.firstApprovalPartIn', '=', 'Waiting For Approval')
            ->orWhere('flow_in_part.firstApprovalPartIn', '=', 'Revision')
            ->orWhere('flow_in_part.firstApprovalPartIn', '=', 'Updated By User')
            ->orWhere('flow_in_part.timeThirdApprovalDocsPartIn', '=', 'Revision')
            ->orWhere('flow_in_part.timeThirdApprovalDocsPartIn', '=', 'Updated By User');
            })
        ->whereNull('flow_in_part.noFtb')
        ->where('flow_in_part.dtStockPartIn', '=', $date)
        ->where('flow_in_part.nameRequester', '=', $name)
        ->where('flow_in_part.departmentRequester', '=', $department)
        ->where('part.lokasiPart', '=', $lokasi)
        ->where('part.kategoriMaterial', '=', $material)
        ->get();

        // dd($query[0]->ReasonThirdApprovalPartIn);
        return view('ApprovalPages.ApprovalDates.showFormIn', 
        ['list' => $query, 'date'=> $date,'name'=>$name,'lokasi'=>$lokasi, 'department'=>$department]);
    }

    public function approveAllIn(Request $request)
    {
        $arrayId = $request->arrayOfId;
        $currTime = Carbon::now()->format('d, M Y [H:i:s]');
        $pic = auth()->user()->name;

        foreach ($arrayId as $id) {
            $data = FlowInPart::find($id);
            $data->firstApprovalPartIn = 'Approved';
            $data->ReasonFirstApprovalPartIn = NULL;
            $data->timeFirstApprovalPartIn = $currTime;
            $data->nameFirstApprovalPartIn = $pic;
            $data->thirdApprovalDocsPartIn = 'Waiting For Approval';
            $data->timeThirdApprovalDocsPartIn = NULL;
            $data->nameThirdApprovalDocsPartIn = NULL;
            $data->ReasonThirdApprovalDocsPartIn = NULL;
            $data->save();

            // HISTORY
            $history = new HistoryIn();
            $history->status = "Approved Dokumen (ADMIN)";
            $history->timeStatus = $currTime;
            $history->name = auth()->user()->name;
            $history->id_flowInPart = $id;
            $history->save();
        }

        $attributePart = FlowInPart::findOrFail($id);

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
            'subject' => 'Pengajuan Formulir Terima Barang',
            'body' => "$namaRequester dari Departemen $departmentRequester telah mengajukan dokumen Formulir Terima Barang(FTB). Yuk segera di approve :)",
        ];
        \Mail::send('email-template',$mail_data, function($message) use ($mail_data){
            $message->to($mail_data['recipient'])
                    ->from($mail_data['fromEmail'], $mail_data['fromName'])
                    ->subject($mail_data['subject']);
        });
        
        return redirect('/flowInPendingApprovalDate')->with('success', 'Berhasil Approve Satu Request');
    }


    public function indexApprovalFisik(){
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
        ->where('thirdApprovalDocsPartIn','=','Approved')
        ->orderBy('dtStockPartIn', 'desc')
        ->distinct()
        ->get();
        return view('ApprovalPages.ApprovalDates.flowInFisik', ['dataset' => $query]);
    }


    public function showFormFisik($date, $name, $lokasi, $department,$material){
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
            'flow_in_part.thirdApprovalDocsPartIn',
            'flow_in_part.nameThirdApprovalDocsPartIn',
            'flow_in_part.timeThirdApprovalDocsPartIn',
            'flow_in_part.ReasonThirdApprovalDocsPartIn',
            'flow_in_part.nameRequester',
            'flow_in_part.filePhotoPartIn',
            'flow_in_part.filePO',
            'flow_in_part.fileBAST',
        )
        ->whereNull('flow_in_part.noFtb')
        ->where('flow_in_part.thirdApprovalDocsPartIn', '=', 'Approved')
        ->where('flow_in_part.dtStockPartIn', '=', $date)
        ->where('flow_in_part.nameRequester', '=', $name)
        ->where('flow_in_part.departmentRequester', '=', $department)
        ->where('part.lokasiPart', '=', $lokasi)
        ->where('part.kategoriMaterial', '=', $material)
        ->get();
       
       
        return view(
            'ApprovalPages.ApprovalDates.showFormIn',
            ['list' => $query, 'date' => $date, 'name' => $name, 'lokasi' => $lokasi, 'department' => $department]
        );
    }

    public function approveFisikAllIn(Request $request){
        $arrayId = $request->arrayOfId;
        $countFtb = DB::table('auto_ftb')
                    ->select('countNoSuratFtb')
                    ->latest()
                    ->first();

        $pic = auth()->user()->name;
        $currTime = Carbon::now()->format('d, M Y [H:i:s]');
        $createdAt = \Carbon\Carbon::now();
        $filter = new IntToRoman();
        $month = $filter->filter(date('n'));
        $year = date("Y");

        $signature = Auth::user()->signature;

        if (empty($countFtb)) {
            $no = 24;
            $autoFtb = new AutoFTB;
            $autoFtb->countNoSuratFtb = $no;
            $autoFtb->created_at = $createdAt;
            $autoFtb->save();
            $format_no = sprintf('%04d', $no);
            $ftb = "No." . $format_no . "/NR" . "/C220" . "/FTB" . "/" . $month . "/" . $year;

            foreach ($arrayId as $id) {
                $data = FlowInPart::find($id);
                $data->noFtb = $ftb;
                $data->secondApprovalPartIn = 'Approved';
                $data->timeSecondApprovalPartIn = $currTime;
                $data->nameSecondApprovalPartIn = $pic;
                $data->ReasonSecondApprovalPartIn = NULL;
                $data->dtStockPartApprovedIn = date('Y-m-d');
                $data->signatureAdmin = $signature;
                $data->save();

                // HISTory
                $history = new HistoryIn();
                $history->status = "Approved Fisik (ADMIN)";
                $history->timeStatus = $currTime;
                $history->name = auth()->user()->name;
                $history->id_flowInPart = $id;
                $history->save();
            }
        } else {
            
            $no = $countFtb->countNoSuratFtb + 1;
            
            $autoFtb = new AutoFTB;
            $autoFtb->countNoSuratFtb = $no;
            $autoFtb->created_at = $createdAt;
            $autoFtb->save();

            $format_no = sprintf('%04d', $no);
            $ftb = "No." . $format_no . "/NR" . "/C220" . "/FTB" . "/" . $month . "/" . $year;

            foreach ($arrayId as $id) {
                $data = FlowInPart::find($id);
                $data->noFtb = $ftb;
                $data->secondApprovalPartIn = 'Approved';
                $data->timeSecondApprovalPartIn = $currTime;
                $data->nameSecondApprovalPartIn = $pic;
                $data->ReasonSecondApprovalPartIn = NULL;
                $data->dtStockPartApprovedIn = date('Y-m-d');
                $data->signatureAdmin = $signature;
                $data->save();

                $history = new HistoryIn();
                $history->status = "Approved Fisik (ADMIN)";
                $history->timeStatus = $currTime;
                $history->name = auth()->user()->name;
                $history->id_flowInPart = $id;
                $history->save();
            }
        }

        $attributePart = FlowInPart::findOrFail($id);

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
            'subject' => 'Pengajuan Formulir Terima Barang',
            'body' => "$namaRequester dari Departemen $departmentRequester mengajukan dokumen Formulir Terima Barang(FTB). Yuk segera di approve :)",
        ];
        \Mail::send('email-template',$mail_data, function($message) use ($mail_data){
            $message->to($mail_data['recipient'])
                    ->from($mail_data['fromEmail'], $mail_data['fromName'])
                    ->subject($mail_data['subject']);
        });

        return redirect('/flowInPendingApprovalFisik')->with('success', 'Berhasil Approved Satu Request');
    }
}
