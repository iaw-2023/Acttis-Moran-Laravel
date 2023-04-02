<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'client_username',
        'purchased_on',
    ];

    /**
     * Get the Ticket Details associated with the Order.
     */
    public function ticketDetails(): HasMany
    {
        return $this->hasMany(TicketDetail::class);
    }

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'orders';
}


