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
        'employees_id',
        'categories_id'
    ];

    public static function getConditionOptions()
    {
        return [
            'good'=> 'Good',
            'condemned' => 'Condemned',
        ];
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}

