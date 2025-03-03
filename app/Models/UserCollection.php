<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserCollection extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'brickheadz_id',
        'date_acquired',
        'price_acquired',
        'image_personal',
        'status',
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
