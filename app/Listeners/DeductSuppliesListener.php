<?php

namespace App\Listeners;

use App\Events\SupplyUpdated;
use App\Models\SupplyTransaction;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class DeductSuppliesListener
{
    /**
     * Handle the event.
     *
     * @param  \App\Events\SupplyUpdated  $event
     * @return void
     */
    public function handle(SupplyUpdated $event)
    {
        $supply = $event->supply;
        $quantityToDeduct = $event->quantityToDeduct;

        // Deduct the quantity
        $supply->quantity -= $quantityToDeduct;
        $supply->save();

        // Record the transaction
        SupplyTransaction::create([
            'assets_id' => $supply->id,
            'stock' => $quantityToDeduct,
            'type' => 'deduction',
        ]);
    }
}
