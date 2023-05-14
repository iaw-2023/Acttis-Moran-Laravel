<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Matchgame extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'played_on_date',
        'played_on_time',
    ];

    /**
     * Get the TeamsPlayingMatch associated with the Matchgame.
     */
    public function teamsPlayingMatch(): HasMany
    {
        return $this->hasMany(TeamPlayingMatch::class, 'matchgame_id');
    }

    /**
     * Get the Stadium associated with the Matchgame.
     */
    public function stadium() : BelongsTo
    {
        return $this->belongsTo(Stadium::class);
    }

    /**
     * Get the Tickets associated with the Matchgame.
     */
    public function tickets() : HasMany
    {
        return $this->hasMany(Ticket::class);
    }

    public function delete(){
        //Soft Delete all tickets associated to Matchgame
        $this->tickets()->delete();

        //Soft Delete all teams playing the match to delete
        $this->teamsPlayingMatch()->delete();

        //Soft Delete Matchgame
        parent::delete();
    }

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'matchgames';
}
