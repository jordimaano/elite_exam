<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Artist extends Model
{
    protected $fillable = [
        'code',
        'name'
    ];

    protected static function boot()
    {
        parent::boot();

        // Register a callback to be executed before a new model is saved.
        static::creating(function ($artist) {
            // Find the maximum existing numeric suffix and increment it
            $latestArtist = self::select(DB::raw('CAST(SUBSTR(code, 3) AS UNSIGNED) AS numeric_code'))
                ->orderBy('numeric_code', 'desc')
                ->first();

            $newNumber = 1;
            if ($latestArtist) {
                $newNumber = $latestArtist->numeric_code + 1;
            }

            // Format the new code (e.g., A-1, A-2, A-10)
            $artist->code = 'A-' . $newNumber;
        });
    }
    public function albums()
    {
        return $this->hasMany(Album::class);
    }
}
