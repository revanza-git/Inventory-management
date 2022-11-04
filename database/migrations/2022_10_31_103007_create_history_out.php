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
        Schema::create('history_out', function (Blueprint $table) {
            $table->id('id_historyOut');
            $table->string('status')->nullable();
            $table->string('timeStatus')->nullable();
            $table->string('reason')->nullable();
            $table->string('name')->nullable();
            $table->unsignedBigInteger('id_flowOutPart')->required;
            $table->foreign('id_flowOutPart')->references('id_flowOutPart')->on('flow_out_part');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('history_out');
    }
};
