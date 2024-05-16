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
            $table->enum('category',['supply', 'services','equipment']);
            $table->string('fund_cluster');
            $table->string('purpose');

            // Foreign key for pr_categories

            // $table->foreign('category_id')->references('id')->on('pr_categories')->onDelete('cascade');


            // Foreign key for pr_items

            // $table->foreign('items_id')->references('id')->on('pr_items')->onDelete('cascade');
            $table->foreignId('pr_items_id')->nullable()->constrained('pr_items')->onDelete('set null');

            // Foreign key for pr_signatories

            // $table->foreign('signatories_id')->references('id')->on('pr_signatories')->onDelete('set Null');
            $table->foreignId('pr_signatories_id')->nullable()->constrained('pr_signatories')->onDelete('set null');

            $table->timestamps();

            // Indexes (add indexes based on your application's needs)
            // $table->index('name');
            // $table->index('employee_id');
        });

        // Migration Documentation
        // This migration creates the purchase_reports table to store purchase reports with references to categories, items, and signatories.
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('purchase_reports', function (Blueprint $table) {
            $table->dropForeign(['category_id']);
            $table->dropForeign(['item_id']);
            $table->dropForeign(['signatory_id']);
        });

        Schema::dropIfExists('purchase_reports');
    }
};
