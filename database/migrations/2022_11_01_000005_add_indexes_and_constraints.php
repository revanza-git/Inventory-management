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
        // Add indexes for better performance
        Schema::table('users', function (Blueprint $table) {
            $table->unique('email');
            $table->index('role');
            $table->index('departement');
        });

        Schema::table('part', function (Blueprint $table) {
            $table->index('kategoriPart');
            $table->index('kategoriMaterial');
            $table->index('lokasiPart');
        });

        Schema::table('flow_in_part', function (Blueprint $table) {
            $table->index('noFtb');
            $table->index('status');
            $table->index('dtStockPartIn');
            $table->index('nameRequester');
            $table->index('departmentRequester');
        });

        Schema::table('flow_out_part', function (Blueprint $table) {
            $table->index('noFkb');
            $table->index('status');
            $table->index('dtStockPartOut');
            $table->index('nameRequester');
            $table->index('departmentRequester');
        });

        Schema::table('history_in', function (Blueprint $table) {
            $table->index('status');
            $table->index('timeStatus');
        });

        Schema::table('history_out', function (Blueprint $table) {
            $table->index('status');
            $table->index('timeStatus');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropUnique(['email']);
            $table->dropIndex(['role']);
            $table->dropIndex(['departement']);
        });

        Schema::table('part', function (Blueprint $table) {
            $table->dropIndex(['kategoriPart']);
            $table->dropIndex(['kategoriMaterial']);
            $table->dropIndex(['lokasiPart']);
        });

        Schema::table('flow_in_part', function (Blueprint $table) {
            $table->dropIndex(['noFtb']);
            $table->dropIndex(['status']);
            $table->dropIndex(['dtStockPartIn']);
            $table->dropIndex(['nameRequester']);
            $table->dropIndex(['departmentRequester']);
        });

        Schema::table('flow_out_part', function (Blueprint $table) {
            $table->dropIndex(['noFkb']);
            $table->dropIndex(['status']);
            $table->dropIndex(['dtStockPartOut']);
            $table->dropIndex(['nameRequester']);
            $table->dropIndex(['departmentRequester']);
        });

        Schema::table('history_in', function (Blueprint $table) {
            $table->dropIndex(['status']);
            $table->dropIndex(['timeStatus']);
        });

        Schema::table('history_out', function (Blueprint $table) {
            $table->dropIndex(['status']);
            $table->dropIndex(['timeStatus']);
        });
    }
}; 