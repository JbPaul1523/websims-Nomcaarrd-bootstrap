<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; // Optional: If you need soft deletes

class PrCategory extends Model
{
    // Optional: Use soft deletes trait
    // use SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'pr_categories';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name'
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
     * Get the purchase reports associated with the category.
     */
    public function purchaseReports()
    {
        return $this->hasMany(PurchaseReport::class, 'pr_categories_id');
    }

    /**
     * Any additional methods you need for business logic here...
     */
}
