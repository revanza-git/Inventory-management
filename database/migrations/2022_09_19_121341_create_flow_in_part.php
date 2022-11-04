<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('flow_in_part', function (Blueprint $table) {
            $table->id('id_flowInPart');
            $table->string('noFtb')->nullable();
            $table->string('nameRequester');
            $table->string('departmentRequester');
            $table->string('noPart');
            $table->string('size')->nullable();
            $table->string('status')->nullable();
            $table->date('dtStockPartIn');
            $table->integer('qtyStockPartIn');
            $table->float('priceStockPartIn');
            $table->year('yearStockPartIn');
            $table->string('needsStockPartIn')->nullable();
            $table->longText('notesPartIn')->nullable();
            $table->string('filePhotoPartIn')->nullable();
            $table->string('filePO')->nullable();
            $table->string('fileBAST')->nullable();
            $table->string('firstApprovalPartIn');
            $table->string('timeFirstApprovalPartIn')->nullable();
            $table->string('nameFirstApprovalPartIn')->nullable();
            $table->string('ReasonFirstApprovalPartIn')->nullable();
            $table->string('secondApprovalPartIn');
            $table->string('timeSecondApprovalPartIn')->nullable();
            $table->string('nameSecondApprovalPartIn')->nullable();
            $table->string('ReasonSecondApprovalPartIn')->nullable();
            $table->string('thirdApprovalPartIn');
            $table->string('timeThirdApprovalPartIn')->nullable();
            $table->string('nameThirdApprovalPartIn')->nullable();
            $table->string('ReasonThirdApprovalPartIn')->nullable();
            $table->string('thirdApprovalDocsPartIn');
            $table->string('timeThirdApprovalDocsPartIn')->nullable();
            $table->string('nameThirdApprovalDocsPartIn')->nullable();
            $table->string('ReasonThirdApprovalDocsPartIn')->nullable();
            $table->string('fourthApprovalPartIn');
            $table->string('timeFourthApprovalPartIn')->nullable();
            $table->string('nameFourthApprovalPartIn')->nullable();
            $table->string('ReasonFourthApprovalPartIn')->nullable();
            $table->date('dtStockPartApprovedIn')->nullable();
            $table->string('signatureUser')->nullable();
            $table->string('signatureAdmin')->nullable();
            $table->string('signatureHead')->nullable();
            $table->string('signatureMaster')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('flow_in_part');
    }
};
