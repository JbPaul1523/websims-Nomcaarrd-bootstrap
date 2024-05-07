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
        Schema::create('purchase_reports', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('pr_no')->unique();
            $table->string('name');
            $table->string('description');
            $table->enum('category', ['equipment','supplies']);
            $table->foreignId('asset_id')->nullable()->constrained('assets')->onDelete('set null');
            $table->foreignId('category_id')->nullable()->constrained('categories')->onDelete('set null');
            $table->foreignId('employee_id')->nullable()->constrained('employees')->onDelete('set null');
            $table->foreignId('equipment_id')->nullable()->constrained('equipments')->onDelete('set null');
            $table->timestamps();

            // Indexes (add indexes based on your application's needs)
            // $table->index('name');
            // $table->index('employee_id');
        });

        // Migration Documentation
        // This migration creates the purchase_reports table to store purchase reports.
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('purchase_reports');
    }
};
