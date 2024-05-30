<?php

// app/Models/AssetDeduction.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssetDeduction extends Model
{
    use HasFactory;

    protected $fillable = ['asset_id', 'deducted_amount'];

    public function asset()
    {
        return $this->belongsTo(Assets::class);
    }
}

