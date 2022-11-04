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
        Schema::table('flow_out_part', function (Blueprint $table) {
            $table->unsignedBigInteger('idPart')->required;
            $table->foreign('idPart')->references('idPart')->on('part');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('flow_out_part', function (Blueprint $table) {
            $table->dropForeign('idPart');
            $table->dropColumn('idPart');
        });
    }
};
