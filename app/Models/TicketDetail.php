<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketDetail extends Model
{
    use HasFactory;

    /**
     * Get the Ticket associated with the Ticket Detail.
     */
    public function ticket(): HasOne
    {
        return $this->hasOne(Ticket::class);
    }
}
