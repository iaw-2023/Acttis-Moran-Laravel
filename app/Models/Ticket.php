<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ticket extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'base_price',
        'category',
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
    public function ticketDetails() : HasMany
    {
        return $this->hasMany(TicketDetail::class);
    }

    /**
     * Get the Matchgame associated with the Ticket.
     */
    public function matchgame() : BelongsTo
    {
        return $this->belongsTo(Matchgame::class)->withTrashed();
    }

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tickets';
}
