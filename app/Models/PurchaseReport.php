<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseReport extends Model
{
    use HasFactory;

    protected $table = 'purchase_reports';
    protected $fillable = [
        '_token',
        'pr_no',
        'name',
        'description',
        'category',
        'asset_id',
        'category_id',
        'employee_id',
        'equipment_id',
    ];

    public static function categoryOption()
    {
        return [
            'equipment'=> 'Equipment',
            'supplies' => 'Supplies',

        ];
    }

    public function asset()
    {
        return $this->belongsTo(Assets::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function equipment()
    {
        return $this->belongsTo(Equipment::class);
    }
}
