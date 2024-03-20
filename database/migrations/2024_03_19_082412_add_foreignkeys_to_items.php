<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('equipments', function (Blueprint $table) {
            $table->foreignId('employees_id')->nullable()->constrained('employees')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('equipments', function (Blueprint $table) {
            $table->dropForeign(['employees_id']);
            $table->dropColumn('employees_id');
        });
    }
};
