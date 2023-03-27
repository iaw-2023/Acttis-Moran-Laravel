<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Stadium extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'located_on_city',
        'name',
        'capacity',
    ];

    /**
     * Get the Team associated with the Stadium.
     */
    public function team() : HasOne
    {
        return $this->hasOne(Team::class, 'local_stadium_id');
    }

    /**
     * Get the Stadium associated with the Team.
     */
    public function matchgames() : HasMany
    {
        return $this->hasMany(Matchgame::class, 'played_in');
    }

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'stadiums';
}
