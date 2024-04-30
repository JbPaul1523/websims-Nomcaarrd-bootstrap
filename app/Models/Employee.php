<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'position'
    ];
    public function equipments()
    {
        return $this->hasMany(Equipment::class, 'employees_id');
    }
    public function employee()
{
    return $this->belongsTo(Employee::class);
}

}
