<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'checkout_date',
        'total_price',
    ];

    /**
     * Get the Ticket Details associated with the Order.
     */
    public function ticketDetails(): HasMany
    {
        return $this->hasMany(TicketDetail::class);
    }

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'orders';
}


