<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Ticket extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'base_price',
    ];

    /**
     * Get the zone that owns the ticket.
     */
    public function zone(): BelongsTo
    {
        return $this->belongsTo(Zone::class);
    }

    
    /**
     * Get the Ticket Detail associated with the Ticket.
     */
    public function ticketDetail()
    {
        return $this->belongsTo(TicketDetail::class);
    }

    /**
     * Get the Matchgame associated with the Ticket.
     */
    public function matchgame() : BelongsTo
    {
        return $this->belongsTo(Matchgame::class);
    }

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tickets';
}
