<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{
    use HasFactory;

    protected $table = 'equipments';

    protected $fillable = [
        'name',
        'serial_number',
        'condition',
        'amount',
        'description',
        'date_acquired',
    ];

    public static function getConditionOptions()
    {
        return [
            'good'=> 'Good',
            'condemned' => 'Condemned',
        ];
    }
}

