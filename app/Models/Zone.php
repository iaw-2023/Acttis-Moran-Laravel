<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Zone extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'stadium_location',
        'zone_code',
        'price_addition',
    ];

    /**
     * Get the Tickets associated with the Zone.
     */
    public function tickets(): HasMany
    {
        return $this->hasMany(Ticket::class, 'zone_id');
    }

    /**
     * Get the Stadium associated with the Zone.
     */

    public function stadium(): BelongsTo
    {
        return $this->belongsTo(Stadium::class);
    }

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'zones';
}
