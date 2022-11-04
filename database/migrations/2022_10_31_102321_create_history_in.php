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
        Schema::create('history_in', function (Blueprint $table) {
            $table->id('id_historyIn');
            $table->string('status')->nullable();
            $table->string('timeStatus')->nullable();
            $table->string('reason')->nullable();
            $table->string('name')->nullable();
            $table->unsignedBigInteger('id_flowInPart')->required;
            $table->foreign('id_flowInPart')->references('id_flowInPart')->on('flow_in_part');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('history_in');
    }
};
