<?php
// app/Models/Assets.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assets extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'amount',
        'stock',
        'date_acquired',
    ];

    public function deductions()
    {
        return $this->hasMany(AssetDeduction::class, 'asset_id');
    }
}
