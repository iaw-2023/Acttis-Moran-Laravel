<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Matchgame extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'played_on',
    ];

    /**
     * Get the Teams associated with the Matchgame.
     */
    public function teams(): HasMany
    {
        return $this->hasMany(Team::class);
    }

    /**
     * Get the Stadium associated with the Matchgame.
     */
    public function stadium() : BelongsTo
    {
        return $this->belongsTo(Stadium::class);
    }

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'matchgames';
}
