<?php

// database/migrations/xxxx_xx_xx_create_supply_reports_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSupplyReportsTable extends Migration
{
    public function up()
    {
        Schema::create('supply_reports', function (Blueprint $table) {
            $table->id();
            $table->string('file_name');
            $table->string('file_path');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('supply_reports');
    }
}

