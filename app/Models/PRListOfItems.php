<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PRListOfItems extends Model
{
    use HasFactory;

    protected $table = "pr_list_items";

    protected $fillable = [
        'pr_id',
        'pr_item_id',
        'quantity',
        'cost',
        'name',
        'created_at',
        'updated_at'
    ];

    public function itemList()
    {
        return $this->belongsTo(PrItem::class, 'id', 'pr_item_id');
    }

    public function purchase_report(){
        return $this->belongsTo(PurchaseReport::class, 'id','pr_id');
    }
}
