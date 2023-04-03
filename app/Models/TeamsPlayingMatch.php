<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;


class TeamsPlayingMatch extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        
    ];

    /**
     * Get the Team associated with the Stadium.
     */
    public function matchgame() : HasOne
    {
        return $this->hasOne(Matchgame::class, 'teams_playing_match_id');
    }

    /**
     * Get the Teams associated with the TeamsPlayingMatch.
     */
    public function teams(): BelongsToMany
    {
        return $this->belongsToMany(Team::class);
    }

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'teams_playing_matches';
}
