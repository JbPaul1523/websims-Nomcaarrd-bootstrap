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
        Schema::create('equipments', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('serial_number')->unique();
            $table->enum('condition', ['good', 'condemned']); // Assuming condition is either 'new' or 'used'
            $table->decimal('amount', 10, 2); // Using decimal for precise currency amounts
            $table->text('description')->nullable();
            $table->date('date_acquired'); // Corrected 'date_aquired' to 'date_acquired'
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('equipments');
    }
};
