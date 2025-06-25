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
        // Remove size column from flow_in_part if it exists (it was moved to part table)
        if (Schema::hasColumn('flow_in_part', 'size')) {
            Schema::table('flow_in_part', function (Blueprint $table) {
                $table->dropColumn('size');
            });
        }

        // Remove size column from flow_out_part if it exists (it was moved to part table)
        if (Schema::hasColumn('flow_out_part', 'size')) {
            Schema::table('flow_out_part', function (Blueprint $table) {
                $table->dropColumn('size');
            });
        }

        // Fix column order in flow_out_part - the schema shows ReasonFirstApprovalPartOut should come before timeFirstApprovalPartOut
        // In Laravel, we can't easily reorder existing columns, so this is mainly for documentation
        // The existing structure will work fine functionally
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Add back size columns if needed
        Schema::table('flow_in_part', function (Blueprint $table) {
            $table->string('size')->nullable();
        });

        Schema::table('flow_out_part', function (Blueprint $table) {
            $table->string('size')->nullable();
        });
    }
}; 