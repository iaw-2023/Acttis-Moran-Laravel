<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
        'stadium_name',
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
     * Get the Matchgames associated with the Stadium.
     */
    public function matchgames() : HasMany
    {
        return $this->hasMany(Matchgame::class, 'stadium_id');
    }

    /**
     * Get the Zones associated with the Stadium.
     */
    public function zones() : HasMany
    {
        return $this->hasMany(Zone::class, 'stadium_id');
    }

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'stadiums';
}
