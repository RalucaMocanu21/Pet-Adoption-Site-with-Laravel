<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    use HasFactory;

    protected $table = 'favorite';
    protected $primaryKey = 'id_favorite';

    protected $fillable = [
        'animal_id', 'created_at', 'updated_at'
    ];


    public function animal()
    {
        return $this->belongsTo(Animal::class, 'animal_id');
    }

    public function user()
    {
        return $this->hasMany(UserFavorite::class, 'favorite_id');
    }
}
