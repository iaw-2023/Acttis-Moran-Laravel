<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'stadiums';
}
