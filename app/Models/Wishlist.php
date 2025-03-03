<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'brickheadz_id',
        'priority',
        'notes',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function brickheadz()
    {
        return $this->belongsTo(Brickheadz::class);
    }
}
