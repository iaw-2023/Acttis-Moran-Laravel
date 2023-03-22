<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
    public function localStadium(): HasOne
    {
        return $this->hasOne(Stadium::class);
    }
}
