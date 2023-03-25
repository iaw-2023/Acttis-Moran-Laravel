<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'price',
    ];

    /*
     Get the Zone associated with the Ticket.
     
    public function zone(): HasOne
    {
        return $this->hasOne(Zone::class);
    }
    */

    
    /**
     * Get the Ticket Detail associated with the Ticket.
     */
    public function ticketDetail()
    {
        return $this->belongsTo(TicketDetail::class);
    }

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tickets';
}
