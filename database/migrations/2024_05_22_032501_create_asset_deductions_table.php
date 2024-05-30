<?php

// database/migrations/xxxx_xx_xx_create_asset_deductions_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssetDeductionsTable extends Migration
{
    public function up()
    {
        Schema::create('asset_deductions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('asset_id')->constrained()->onDelete('cascade');
            $table->integer('deducted_amount');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('asset_deductions');
    }
}
