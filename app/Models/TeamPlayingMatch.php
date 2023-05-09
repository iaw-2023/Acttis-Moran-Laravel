<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class TeamPlayingMatch extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'condition',
    ];

    /**
     * Get the Team associated with the Stadium.
     */
    public function matchgame() : BelongsTo
    {
        return $this->belongsTo(Matchgame::class);
    }

    /**
     * Get the Team associated with the TeamPlayingMatch.
     */
    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'teams_playing_matchs';
}
