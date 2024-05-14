<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'employees_id',
        'equipments_id',
        'assets_id',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employees_id');
    }

    public function equipment()
    {
        return $this->belongsTo(Equipment::class, 'equipments_id');
    }

    public function asset()
    {
        return $this->belongsTo(Assets::class, 'assets_id');
    }
}
