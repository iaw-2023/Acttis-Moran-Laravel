<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;


    /**
     * Get the Teams associated with the Matchgame.
     */
    public function ticketDetails(): HasMany
    {
        return $this->hasMany(TicketDetail::class);
    }
}


