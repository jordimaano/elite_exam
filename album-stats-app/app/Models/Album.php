<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    //
    protected $fillable = [
        'year',
        'name',
        'sales',
        'details',
        'album_cover',
        'artist_id',
    ];
}
