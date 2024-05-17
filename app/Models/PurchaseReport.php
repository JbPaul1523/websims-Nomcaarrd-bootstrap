<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; // Optional: If you need soft deletes

class PurchaseReport extends Model
{
    // Optional: Use soft deletes trait
    // use SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'purchase_reports';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'pr_no',
        'name',
        'fund_cluster',
        'purpose',
        'pr_categories_id',
        'pr_items_id',
        'pr_signatories_id',
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
     * Get the category associated with the purchase report.
     */
    // public function category()
    // {
    //     return $this->belongsTo('App\Models\PrCategory', 'pr_categories_id');
    // }

    /**
     * Get the items associated with the purchase report.
     */
    public function items()
    {
        return $this->belongsTo('App\Models\PrItem', 'pr_items_id');
    }

    public static function getCategory()
    {
        return [
            'supply'=> 'Supply',
            'equipment' => 'Equipment',
            'services' => 'Services'
        ];
    }

    /**
     * Get the signatories associated with the purchase report.
     */
    public function signatories()
    {
        return $this->belongsTo('App\Models\PrSignatory', 'pr_signatories_id');
    }

    /**
     * Any additional methods you need for business logic here...
     */

     public function itemList(){
        return $this->hasMany(PRListOfItems::class, 'pr_id', 'id');
     }
}
