<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Stadium;

class Team extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'team_name',
    ];

    /**
     * Get the Stadium associated with the Team.
     */
    public function stadium() : BelongsTo
    {
        return $this->belongsTo(Stadium::class);
    }

    /**
     * Get the TeamsPlayingMatch associated with the Team.
     */
    public function teamPlayingMatchs() : HasMany
    {
        return $this->hasMany(TeamPlayingMatch::class, 'team_id');
    }

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'teams';
}
