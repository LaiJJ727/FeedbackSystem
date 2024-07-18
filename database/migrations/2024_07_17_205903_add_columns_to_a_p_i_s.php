<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('a_p_i_s', function (Blueprint $table) {
            //Add two column 
            $table->string('service_name');
            $table->string('service_type');
            $table->string('in_used');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('a_p_i_s', function (Blueprint $table) {
            //Drop columns when roll back
            $table->dropColumn('service_name');
            $table->dropColumn('service_type');
            $table->dropColumn('in_used');
        });
    }
};
