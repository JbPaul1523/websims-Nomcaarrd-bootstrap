<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; // Optional: If you need soft deletes

class PrItem extends Model
{
    // Optional: Use soft deletes trait
    // use SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'pr_items';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'description',
        'price',
        'itemcategory',
        'unit'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        // Define attributes that should be hidden
    ];

    /**
     * Get the purchase reports associated with the item.
     */
    public function purchaseReports()
    {
        return $this->hasMany(PurchaseReport::class, 'pr_items_id');
    }

    /**
     * Any additional methods you need for business logic here...
     */
    public static function getPrItemCategory()
    {
        return [
            'supply'=> 'Supply',
            'equipment' => 'Equipment',
            'services' => 'Services'
        ];
    }
}
