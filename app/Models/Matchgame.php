<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
