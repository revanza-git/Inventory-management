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
        Schema::create('flow_out_part', function (Blueprint $table) {
            $table->id('id_flowOutPart');
            $table->string('noFkb')->nullable();
            $table->string('nameRequester');
            $table->string('departmentRequester');
            $table->string('noPart');
            $table->string('size')->nullable();
            $table->string('status')->nullable();
            $table->date('dtStockPartOut');
            $table->integer('qtyStockPartOut');
            $table->float('priceStockPartOut');
            $table->year('yearStockPartOut');
            $table->string('needsStockPartOut')->nullable();
            $table->longText('notesPartOut')->nullable();
            $table->string('filePhotoPartOut')->nullable();
            $table->string('filePO')->nullable();
            $table->string('fileBAST')->nullable();
            $table->string('firstApprovalPartOut');
            $table->string('ReasonFirstApprovalPartOut')->nullable();
            $table->string('timeFirstApprovalPartOut')->nullable();
            $table->string('nameFirstApprovalPartOut')->nullable();
            $table->string('secondApprovalPartOut');
            $table->string('ReasonSecondApprovalPartOut')->nullable();
            $table->string('timeSecondApprovalPartOut')->nullable();
            $table->string('nameSecondApprovalPartOut')->nullable();
            $table->string('thirdApprovalPartOut');
            $table->string('ReasonThirdApprovalPartOut')->nullable();
            $table->string('timeThirdApprovalPartOut')->nullable();
            $table->string('nameThirdApprovalPartOut')->nullable();
            $table->string('thirdApprovalDocsPartOut');
            $table->string('timeThirdApprovalDocsPartOut')->nullable();
            $table->string('nameThirdApprovalDocsPartOut')->nullable();
            $table->string('ReasonThirdApprovalDocsPartOut')->nullable();
            $table->string('fourthApprovalPartOut');
            $table->string('ReasonFourthApprovalPartOut')->nullable();
            $table->string('timeFourthApprovalPartOut')->nullable();
            $table->string('nameFourthApprovalPartOut')->nullable();
            $table->date('dtStockPartApprovedOut')->nullable();
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
        Schema::dropIfExists('flow_out_part');
    }
};
