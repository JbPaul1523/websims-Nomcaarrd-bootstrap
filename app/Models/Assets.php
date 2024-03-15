<?php

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
}
