<?php

namespace App\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\Assets;

class SupplyUpdated
{
    use Dispatchable, SerializesModels;

    public $supply;
    public $quantityToDeduct;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Assets $supply, $quantityToDeduct)
    {
        $this->supply = $supply;
        $this->quantityToDeduct = $quantityToDeduct;
    }
}
