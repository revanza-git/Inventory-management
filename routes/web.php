<?php

use App\Http\Controllers\AdminOldStockController;
use App\Models\FlowInPart;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PartController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\FlowInPendingHead;
use App\Http\Controllers\FlowOutPendingHead;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\FlowInPendingMaster;
use App\Http\Controllers\FlowInPartController;
use App\Http\Controllers\FlowOutPendingMaster;
use App\Http\Controllers\FlowInPendingApproval;
use App\Http\Controllers\FlowOutPartController;
use App\Http\Controllers\UserRequestController;
use App\Http\Controllers\FlowOutPendingApproval;
use App\Http\Controllers\ReportController;

Route::get('/', function () {
    // return view('welcome');
    return view('login');
});


Route::get('/login',[LoginController::class,'index'])->name('login');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);


Route::middleware(['auth', 'cekrole:superadmin'])->group(function () {
    Route::get('/register', [RegisterController::class, 'index']);
    Route::post('/register', [RegisterController::class, 'store']);
    Route::get('/resetPassword', [RegisterController::class, 'getAccount']);
    Route::get('/showAccount/{id}', [RegisterController::class, 'showAccount']);
    Route::post('/resetPassword/{id}', [RegisterController::class, 'resetPassword']);
});



Route::middleware(['auth', 'cekrole:master'])->group(function () {
    Route::get('/flowInPendingMaster', [FlowInPendingMaster::class, 'index']);
    Route::post('/detailFlowInFinalMaster', [FlowInPendingMaster::class, 'showAllPendingIn']);
    Route::post('/approveFlowInFinalMaster', [FlowInPendingMaster::class, 'approveAllIn']);

    Route::get('/flowOutPendingMaster', [FlowOutPendingMaster::class, 'index']);
    Route::post('/detailFlowOutFinalMaster', [FlowOutPendingMaster::class, 'showAllPendingOut']);
    Route::post('/approveFlowOutFinalMaster', [FlowOutPendingMaster::class, 'approveAllOut']);
    
});

Route::middleware(['auth', 'cekrole:master,admin'])->group(function () {

    Route::get('/report', [ReportController::class, 'index']);
    Route::post('/showReport', [ReportController::class, 'showReport']);
    Route::post('/showReportKategoriMaterial', [ReportController::class, 'showReportKategoriMaterial']);
    Route::post('/showReportLokasi', [ReportController::class, 'showReportLokasi']);
    Route::post('/showReportAll', [ReportController::class, 'showReportAll']);
    // EXPORT REPORT
    Route::post('/export-report', [ReportController::class, 'exportReport']);
    Route::post('/exportCategory-report', [ReportController::class, 'exportCategoryReport']);
    Route::post('/exportLokasi-report', [ReportController::class, 'exportLokasiReport']);
    Route::post('/exportAll-report', [ReportController::class, 'exportAllReport']);


    Route::post('/showCustomReport', [ReportController::class, 'showCustomReport']);
    Route::post('/showCustomReportKategoriMaterial', [ReportController::class, 'showCustomReportKategoriMaterial']);
    Route::post('/showCustomReportLokasi', [ReportController::class, 'showCustomReportLokasi']);
    Route::post('/showCustomReportAll', [ReportController::class, 'showCustomReportAll']);

    Route::post('/exportCustom-report', [ReportController::class, 'exportCustomReport']);
    Route::post('/exportCustomCategory-report', [ReportController::class, 'exportCustomCategoryReport']);
    Route::post('/exportCustomLokasi-report',[ReportController::class, 'exportCustomLokasiReport']);
    Route::post('/exportCustomAll-report', [ReportController::class, 'exportCustomAllReport']);
});


Route::middleware(['auth', 'cekrole:head'])->group(function () {
    Route::get('/flowInPendingHead', [FlowInPendingHead::class, 'index']);
    Route::get('/aprroveInHead/{date}/{name}/{lokasi}/{department}/{material}', [FlowInPendingHead::class, 'showAllPendingIn']);
    Route::post('/approveAllInHead', [FlowInPendingHead::class, 'approveAllIn']);
    Route::post('/revisionAllInHead', [FlowInPendingHead::class, 'revisionAllIn']);

    Route::get('/flowInFinalHead', [FlowInPendingHead::class, 'indexFinal']);
    Route::post('/detailflowInFinalHead', [FlowInPendingHead::class, 'showDetailFinalFlowIn']);
    Route::post('/approveFlowInFinalHead', [FlowInPendingHead::class, 'approveFlowInFinal']);

    Route::get('/flowOutPendingHead', [FlowOutPendingHead::class, 'index']);
    Route::get('/aprroveOutHead/{date}/{name}/{lokasi}/{department}/{material}', [FlowOutPendingHead::class, 'showAllPendingOut']);
    Route::post('/approveAllOutHead', [FlowOutPendingHead::class, 'approveAllOut']);
    Route::post('/revisionAllOutHead', [FlowOutPendingHead::class, 'revisionAllOut']);

    Route::get('/flowOutFinalHead', [FlowOutPendingHead::class, 'indexFinal']);
    Route::post('/detailflowOutFinalHead', [FlowOutPendingHead::class, 'showDetailFinalFlowOut']);
    Route::post('/approveFlowOutFinalHead', [FlowOutPendingHead::class, 'approveFlowOutFinal']);
});


// TODO:APPROVAL
Route::middleware(['auth', 'cekrole:admin,head,master'])->group(function () {
    Route::get('/flowInPendingApproval', [FlowInPendingApproval::class, 'index']);
    Route::get('/flowInPending-detail/{id}', [FlowInPendingApproval::class,'showDetail']);
    Route::get('/flowOutPendingApproval', [FlowOutPendingApproval::class, 'index']);
    Route::get('/flowOutPending-detail/{id}', [FlowOutPendingApproval::class, 'showDetail']);

    Route::get('/approveDokumenIn/{id}',[FlowInPendingApproval::class, 'approveDokumenIn']);
    Route::get('/approveFisikIn/{id}', [FlowInPendingApproval::class, 'approveFisikIn']);
    Route::get('/rejectDokumenIn/{id}', [FlowInPendingApproval::class, 'rejectDokumenIn']);
    Route::get('/approveDokumenOut/{id}', [FlowOutPendingApproval::class, 'approveDokumenOut']);
    Route::get('/approveFisikOut/{id}', [FlowOutPendingApproval::class, 'approveFisikOut']);
    Route::get('/rejectDokumenOut/{id}', [FlowOutPendingApproval::class, 'rejectDokumenOut']);
    

    Route::get('/reasonsFirstApprovalIn/{id}', [FlowInPendingApproval::class, 'showReasonFirstApproval']);
    Route::post('/reasonsFirstApprovalIn/{id}', [FlowInPendingApproval::class, 'postReasonFirstApproval']);
    Route::get('/reasonsFirstApprovalOut/{id}', [FlowOutPendingApproval::class, 'showReasonFirstApproval']);
    Route::post('/reasonsFirstApprovalOut/{id}', [FlowOutPendingApproval::class, 'postReasonFirstApproval']);
    Route::get('/reasonsSecondApprovalIn/{id}', [FlowInPendingApproval::class, 'showReasonSecondApproval']);
    Route::post('/reasonsSecondApprovalIn/{id}', [FlowInPendingApproval::class, 'postReasonSecondApproval']);
    Route::get('/reasonsSecondApprovalOut/{id}', [FlowOutPendingApproval::class, 'showReasonSecondApproval']);
    Route::post('/reasonsSecondApprovalOut/{id}', [FlowOutPendingApproval::class, 'postReasonSecondApproval']);

    // APPROVAL BASED ON FORM

    Route::get('/flowInPendingApprovalDate', [FlowInPendingApproval::class, 'indexApprovalDate']);
    Route::get('/aprroveInAdminDate/{date}/{name}/{lokasi}/{department}/{material}', [FlowInPendingApproval::class, 'showForm']);
    Route::post('/approveAllIn', [FlowInPendingApproval::class, 'approveAllIn']);

    Route::get('/flowInPendingApprovalFisik', [FlowInPendingApproval::class, 'indexApprovalFisik']);
    Route::get('/aprroveInAdminFisik/{date}/{name}/{lokasi}/{department}/{material}', [FlowInPendingApproval::class, 'showFormFisik']);
    Route::post('/approveFisikAllIn', [FlowInPendingApproval::class, 'approveFisikAllIn']);

    Route::get('/flowOutPendingApprovalDate', [FlowOutPendingApproval::class, 'indexApprovalDate']);
    Route::get('/aprroveOutAdminDate/{date}/{name}/{lokasi}/{department}/{material}', [FlowOutPendingApproval::class, 'showForm']);
    Route::post('/approveAllOut', [FlowOutPendingApproval::class, 'approveAllOut']);

    Route::get('/flowOutPendingApprovalFisik', [FlowOutPendingApproval::class, 'indexApprovalFisik']);
    Route::get('/aprroveOutAdminFisik/{date}/{name}/{lokasi}/{department}/{material}', [FlowOutPendingApproval::class, 'showFormFisik']);
    Route::post('/approveFisikAllOut', [FlowOutPendingApproval::class, 'approveFisikAllOut']);

    // TODO:STOK LAMPAU
    Route::get('/plusOldStock/{id}',[AdminOldStockController::class,'createPlusOldDataStock']);
    Route::post('/plusOldStock/{id}',[AdminOldStockController::class,'storePlusOldDataStock']);
    Route::get('/minusOldStock/{id}', [AdminOldStockController::class, 'createMinusOldDataStock']);
    Route::post('/minusOldStock/{id}', [AdminOldStockController::class, 'storeMinusOldDataStock']);
});



// TODO:USER (SAMPE SINI)
Route::middleware(['auth', 'cekrole:user,head,admin,master'])->group(function () {
    Route::get('/home', [HomeController::class, 'index']);
    Route::get('/addPart', [PartController::class, 'createPart']);
    Route::post('/part-postNewData', [PartController::class, 'storeNewPart']);
    // USER REQUEST (PENDING)
    Route::get('/myRequest',[UserRequestController::class, 'index']);
    Route::get('/userPendingFormIn/{date}/{name}/{lokasi}/{department}/{material}', [UserRequestController::class, 'showFormIn']);
    Route::get('/userPendingFormOut/{date}/{name}/{lokasi}/{department}/{material}', [UserRequestController::class, 'showFormOut']);
    // USER REQUEST(APPROVED)
    Route::get('/ftb', [UserRequestController::class, 'indexFtb']);
    Route::post('/detailFtb', [UserRequestController::class, 'showDetailFtb']);
    Route::post('/exportFtb', [UserRequestController::class, 'exportFtb']);
    Route::post('/exportHistoryFtb', [UserRequestController::class, 'exportHistoryFtb']);
    Route::get('/fkb', [UserRequestController::class, 'indexFkb']);
    Route::post('/detailFkb', [UserRequestController::class, 'showDetailFkb']);
    Route::post('/exportFkb', [UserRequestController::class, 'exportFkb']);
    Route::post('/exportHistoryFkb', [UserRequestController::class, 'exportHistoryFkb']);
    // ROUTE UPDATE FISIK
    // Route::get('/updateUserFisikIn/{id}', [FlowInPartController::class, 'updateFisikIn']);
    Route::get('/updateUserFisikOut/{id}', [FlowOutPartController::class, 'updateFisikOut']);

    // TODO:ELECTRICAL
    Route::get('/electrical', [PartController::class, 'showIndexElectrical']);
    Route::get('/electrical-detail/{id}', [PartController::class, 'showRecords']);
    Route::post('/electrical-trace/{id}', [PartController::class, 'traceRecords']);
    Route::get('/electrical-edit/{id}', [PartController::class, 'edit']);
    Route::put('/electrical/{id}', [PartController::class, 'update']);
    
    Route::get('/electrical-plus-stock/{id}', [FlowInPartController::class, 'createDataPlusStock']);
    Route::post('/electrical-plus-stock/{id}', [FlowInPartController::class, 'storeDataPlusStock']);
    Route::get('/flowInElectrical-edit/{id}', [FlowInPartController::class, 'edit']);
    Route::put('/flowInElectrical/{id}', [FlowInPartController::class, 'update']);
    Route::get('/flowInElectrical-detail/{id}', [FlowInPartController::class, 'showDetail']);

    Route::get('/electrical-minus-stock/{id}', [FlowOutPartController::class, 'createDataMinusStock']);
    Route::get('/part-minus-findData/{noPart}', [FlowOutPartController::class, 'getData']);
    Route::post('/electrical-minus-stock/{id}', [FlowOutPartController::class, 'storeDataMinusStock']);
    Route::get('/flowOutElectrical-edit/{id}', [FlowOutPartController::class, 'edit']);
    Route::put('/flowOutElectrical/{id}', [FlowOutPartController::class, 'update']);
    Route::get('/flowOutElectrical-detail/{id}', [FlowOutPartController::class, 'showDetail']);


    // TODO:INSTRUMENT
    Route::get('/instrument', [PartController::class, 'showIndexInstrument']);
    Route::get('/instrument-detail/{id}', [PartController::class, 'showRecords']);
    Route::post('/instrument-trace/{id}', [PartController::class, 'traceRecords']);
    Route::get('/instrument-edit/{id}', [PartController::class, 'edit']);
    Route::put('/instrument/{id}', [PartController::class, 'update']);

    Route::get('/instrument-plus-stock/{id}', [FlowInPartController::class, 'createDataPlusStock']);
    Route::post('/instrument-plus-stock/{id}', [FlowInPartController::class, 'storeDataPlusStock']);
    Route::get('/flowInInstrument-edit/{id}', [FlowInPartController::class, 'edit']);
    Route::put('/flowInInstrument/{id}', [FlowInPartController::class, 'update']);
    Route::get('/flowInInstrument-detail/{id}', [FlowInPartController::class, 'showDetail']);
    
    Route::get('/instrument-minus-stock/{id}', [FlowOutPartController::class, 'createDataMinusStock']);
    Route::post('/instrument-minus-stock/{id}', [FlowOutPartController::class, 'storeDataMinusStock']);
    Route::get('/flowOutInstrument-edit/{id}', [FlowOutPartController::class, 'edit']);
    Route::put('/flowOutInstrument/{id}', [FlowOutPartController::class, 'update']);
    Route::get('/flowOutInstrument-detail/{id}', [FlowOutPartController::class, 'showDetail']);


    // TODO:MECHANICAL
    Route::get('/mechanical', [PartController::class, 'showIndexMechanical']);
    Route::get('/mechanical-detail/{id}', [PartController::class, 'showRecords']);
    Route::post('/mechanical-trace/{id}', [PartController::class, 'traceRecords']);
    Route::get('/mechanical-edit/{id}', [PartController::class, 'edit']);
    Route::put('/mechanical/{id}', [PartController::class, 'update']);

    Route::get('/mechanical-plus-stock/{id}', [FlowInPartController::class, 'createDataPlusStock']);
    Route::post('/mechanical-plus-stock/{id}', [FlowInPartController::class, 'storeDataPlusStock']);
    Route::get('/flowInMechanical-edit/{id}', [FlowInPartController::class, 'edit']);
    Route::put('/flowInMechanical/{id}', [FlowInPartController::class, 'update']);
    Route::get('/flowInMechanical-detail/{id}', [FlowInPartController::class, 'showDetail']);

    Route::get('/mechanical-minus-stock/{id}', [FlowOutPartController::class, 'createDataMinusStock']);
    
    Route::post('/mechanical-minus-stock/{id}', [FlowOutPartController::class, 'storeDataMinusStock']);
    Route::get('/flowOutMechanical-edit/{id}', [FlowOutPartController::class, 'edit']);
    Route::put('/flowOutMechanical/{id}', [FlowOutPartController::class, 'update']);
    Route::get('/flowOutMechanical-detail/{id}', [FlowOutPartController::class, 'showDetail']);

    // TODO:PROVISION
    Route::get('/provision', [PartController::class, 'showIndexProvision']);
    Route::get('/provision-detail/{id}', [PartController::class, 'showRecords']);
    Route::post('/provision-trace/{id}', [PartController::class, 'traceRecords']);
    Route::get('/provision-edit/{id}', [PartController::class, 'edit']);
    Route::put('/provision/{id}', [PartController::class, 'update']);

    Route::get('/provision-plus-stock/{id}', [FlowInPartController::class, 'createDataPlusStock']);
    Route::post('/provision-plus-stock/{id}', [FlowInPartController::class, 'storeDataPlusStock']);
    Route::get('/flowInProvision-edit/{id}', [FlowInPartController::class, 'edit']);
    Route::put('/flowInProvision/{id}', [FlowInPartController::class, 'update']);
    Route::get('/flowInProvision-detail/{id}', [FlowInPartController::class, 'showDetail']);

    Route::get('/provision-minus-stock/{id}', [FlowOutPartController::class, 'createDataMinusStock']);
    Route::post('/provision-minus-stock/{id}', [FlowOutPartController::class, 'storeDataMinusStock']);
    Route::get('/flowOutProvision-edit/{id}', [FlowOutPartController::class, 'edit']);
    Route::put('/flowOutProvision/{id}', [FlowOutPartController::class, 'update']);
    Route::get('/flowOutProvision-detail/{id}', [FlowOutPartController::class, 'showDetail']);

    // TODO:EMERGENCY
    Route::get('/emergency', [PartController::class, 'showIndexEmergency']);
    Route::get('/emergency-detail/{id}', [PartController::class, 'showRecords']);
    Route::post('/emergency-trace/{id}', [PartController::class, 'traceRecords']);
    Route::get('/emergency-edit/{id}', [PartController::class, 'edit']);
    Route::put('/emergency/{id}', [PartController::class, 'update']);

    Route::get('/emergency-plus-stock/{id}', [FlowInPartController::class, 'createDataPlusStock']);
    Route::post('/emergency-plus-stock/{id}', [FlowInPartController::class, 'storeDataPlusStock']);
    Route::get('/flowInEmergency-edit/{id}', [FlowInPartController::class, 'edit']);
    Route::put('/flowInEmergency/{id}', [FlowInPartController::class, 'update']);
    Route::get('/flowInEmergency-detail/{id}', [FlowInPartController::class, 'showDetail']);

    Route::get('/emergency-minus-stock/{id}', [FlowOutPartController::class, 'createDataMinusStock']);
    Route::post('/emergency-minus-stock/{id}', [FlowOutPartController::class, 'storeDataMinusStock']);
    Route::get('/flowOutEmergency-edit/{id}', [FlowOutPartController::class, 'edit']);
    Route::put('/flowOutEmergency/{id}', [FlowOutPartController::class, 'update']);
    Route::get('/flowOutEmergency-detail/{id}', [FlowOutPartController::class, 'showDetail']);

    // TODO:Reliability
    Route::get('/reliability', [PartController::class, 'showIndexReliability']);
    Route::get('/reliability-detail/{id}', [PartController::class, 'showRecords']);
    Route::post('/reliability-trace/{id}', [PartController::class, 'traceRecords']);
    Route::get('/reliability-edit/{id}', [PartController::class, 'edit']);
    Route::put('/reliability/{id}', [PartController::class, 'update']);

    Route::get('/reliability-plus-stock/{id}', [FlowInPartController::class, 'createDataPlusStock']);
    Route::post('/reliability-plus-stock/{id}', [FlowInPartController::class, 'storeDataPlusStock']);
    Route::get('/flowInReliability-edit/{id}', [FlowInPartController::class, 'edit']);
    Route::put('/flowInReliability/{id}', [FlowInPartController::class, 'update']);
    Route::get('/flowInReliability-detail/{id}', [FlowInPartController::class, 'showDetail']);

    Route::get('/reliability-minus-stock/{id}', [FlowOutPartController::class, 'createDataMinusStock']);
    Route::post('/reliability-minus-stock/{id}', [FlowOutPartController::class, 'storeDataMinusStock']);
    Route::get('/flowOutReliability-edit/{id}', [FlowOutPartController::class, 'edit']);
    Route::put('/flowOutReliability/{id}', [FlowOutPartController::class, 'update']);
    Route::get('/flowOutReliability-detail/{id}', [FlowOutPartController::class, 'showDetail']);


    // TODO:Scrap
    Route::get('/scrap', [PartController::class, 'showIndexScrap']);
    Route::get('/scrap-detail/{id}', [PartController::class, 'showRecords']);
    Route::post('/scrap-trace/{id}', [PartController::class, 'traceRecords']);
    Route::get('/scrap-edit/{id}', [PartController::class, 'edit']);
    Route::put('/scrap/{id}', [PartController::class, 'update']);

    Route::get('/scrap-plus-stock/{id}', [FlowInPartController::class, 'createDataPlusStock']);
    Route::post('/scrap-plus-stock/{id}', [FlowInPartController::class, 'storeDataPlusStock']);
    Route::get('/flowInScrap-edit/{id}', [FlowInPartController::class, 'edit']);
    Route::put('/flowInScrap/{id}', [FlowInPartController::class, 'update']);
    Route::get('/flowInScrap-detail/{id}', [FlowInPartController::class, 'showDetail']);

    Route::get('/scrap-minus-stock/{id}', [FlowOutPartController::class, 'createDataMinusStock']);
    Route::post('/scrap-minus-stock/{id}', [FlowOutPartController::class, 'storeDataMinusStock']);
    Route::get('/flowOutScrap-edit/{id}', [FlowOutPartController::class, 'edit']);
    Route::put('/flowOutScrap/{id}', [FlowOutPartController::class, 'update']);
    Route::get('/flowOutScrap-detail/{id}', [FlowOutPartController::class, 'showDetail']);

    // TECH
    Route::get('/technology', [PartController::class, 'showIndexTechnology']);
    Route::get('/technology-detail/{id}', [PartController::class, 'showRecords']);
    Route::post('/technology-trace/{id}', [PartController::class, 'traceRecords']);
    Route::get('/technology-edit/{id}', [PartController::class, 'edit']);
    Route::put('/technology/{id}', [PartController::class, 'update']);

    Route::get('/technology-plus-stock/{id}', [FlowInPartController::class, 'createDataPlusStock']);
    Route::post('/technology-plus-stock/{id}', [FlowInPartController::class, 'storeDataPlusStock']);
    Route::get('/flowInTechnology-edit/{id}', [FlowInPartController::class, 'edit']);
    Route::put('/flowInTechnology/{id}', [FlowInPartController::class, 'update']);
    Route::get('/flowInTechnology-detail/{id}', [FlowInPartController::class, 'showDetail']);

    Route::get('/technology-minus-stock/{id}', [FlowOutPartController::class, 'createDataMinusStock']);
    Route::post('/technology-minus-stock/{id}', [FlowOutPartController::class, 'storeDataMinusStock']);
    Route::get('/flowOutTechnology-edit/{id}', [FlowOutPartController::class, 'edit']);
    Route::put('/flowOutTechnology/{id}', [FlowOutPartController::class, 'update']);
    Route::get('/flowOutTechnology-detail/{id}', [FlowOutPartController::class, 'showDetail']);

    // LAYUM (TIYUM)
    Route::get('/tiyum', [PartController::class, 'showIndexTiyum']);
    Route::get('/tiyum-detail/{id}', [PartController::class, 'showRecords']);
    Route::post('/tiyum-trace/{id}', [PartController::class, 'traceRecords']);
    Route::get('/tiyum-edit/{id}', [PartController::class, 'edit']);
    Route::put('/tiyum/{id}', [PartController::class, 'update']);

    Route::get('/tiyum-plus-stock/{id}', [FlowInPartController::class, 'createDataPlusStock']);
    Route::post('/tiyum-plus-stock/{id}', [FlowInPartController::class, 'storeDataPlusStock']);
    Route::get('/flowInTiyum-edit/{id}', [FlowInPartController::class, 'edit']);
    Route::put('/flowInTiyum/{id}', [FlowInPartController::class, 'update']);
    Route::get('/flowInTiyum-detail/{id}', [FlowInPartController::class, 'showDetail']);

    Route::get('/tiyum-minus-stock/{id}', [FlowOutPartController::class, 'createDataMinusStock']);
    Route::post('/tiyum-minus-stock/{id}', [FlowOutPartController::class, 'storeDataMinusStock']);
    Route::get('/flowOutTiyum-edit/{id}', [FlowOutPartController::class, 'edit']);
    Route::put('/flowOutTiyum/{id}', [FlowOutPartController::class, 'update']);
    Route::get('/flowOutTiyum-detail/{id}', [FlowOutPartController::class, 'showDetail']);

    // LAYUM (SCRAYUM)
    Route::get('/scrayum', [PartController::class, 'showIndexScrayum']);
    Route::get('/scrayum-detail/{id}', [PartController::class, 'showRecords']);
    Route::post('/scrayum-trace/{id}', [PartController::class, 'traceRecords']);
    Route::get('/scrayum-edit/{id}', [PartController::class, 'edit']);
    Route::put('/scrayum/{id}', [PartController::class, 'update']);

    Route::get('/scrayum-plus-stock/{id}', [FlowInPartController::class, 'createDataPlusStock']);
    Route::post('/scrayum-plus-stock/{id}', [FlowInPartController::class, 'storeDataPlusStock']);
    Route::get('/flowInScrayum-edit/{id}', [FlowInPartController::class, 'edit']);
    Route::put('/flowInScrayum/{id}', [FlowInPartController::class, 'update']);
    Route::get('/flowInScrayum-detail/{id}', [FlowInPartController::class, 'showDetail']);

    Route::get('/scrayum-minus-stock/{id}', [FlowOutPartController::class, 'createDataMinusStock']);
    Route::post('/scrayum-minus-stock/{id}', [FlowOutPartController::class, 'storeDataMinusStock']);
    Route::get('/flowOutScrayum-edit/{id}', [FlowOutPartController::class, 'edit']);
    Route::put('/flowOutScrayum/{id}', [FlowOutPartController::class, 'update']);
    Route::get('/flowOutScrayum-detail/{id}', [FlowOutPartController::class, 'showDetail']);

    // SEKPER
    Route::get('/sekper', [PartController::class, 'showIndexSekper']);
    Route::get('/sekper-detail/{id}', [PartController::class, 'showRecords']);
    Route::post('/sekper-trace/{id}', [PartController::class, 'traceRecords']);
    Route::get('/sekper-edit/{id}', [PartController::class, 'edit']);
    Route::put('/sekper/{id}', [PartController::class, 'update']);

    Route::get('/sekper-plus-stock/{id}', [FlowInPartController::class, 'createDataPlusStock']);
    Route::post('/sekper-plus-stock/{id}', [FlowInPartController::class, 'storeDataPlusStock']);
    Route::get('/flowInSekper-edit/{id}', [FlowInPartController::class, 'edit']);
    Route::put('/flowInSekper/{id}', [FlowInPartController::class, 'update']);
    Route::get('/flowInSekper-detail/{id}', [FlowInPartController::class, 'showDetail']);

    Route::get('/sekper-minus-stock/{id}', [FlowOutPartController::class, 'createDataMinusStock']);
    Route::post('/sekper-minus-stock/{id}', [FlowOutPartController::class, 'storeDataMinusStock']);
    Route::get('/flowOutSekper-edit/{id}', [FlowOutPartController::class, 'edit']);
    Route::put('/flowOutSekper/{id}', [FlowOutPartController::class, 'update']);
    Route::get('/flowOutSekper-detail/{id}', [FlowOutPartController::class, 'showDetail']);
});








