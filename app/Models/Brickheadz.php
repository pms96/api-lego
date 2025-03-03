<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brickheadz extends Model
{
    use HasFactory;

    protected $fillable = [
        'lego_id',
        'name',
        'name_plate',
        'image',
        'release_date',
        'is_discontinued',
    ];

    public function collections()
    {
        return $this->hasMany(UserCollection::class);
    }

    public function wishlists()
    {
        return $this->hasMany(Wishlist::class);
    }
}
