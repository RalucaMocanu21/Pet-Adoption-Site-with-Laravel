<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserFavorite extends Model
{
    use HasFactory;

    protected $table = 'user_favorite';

    protected $primaryKey = 'id_user_favorite';

    protected $fillable = [
        'user_id', 'favorite_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function favorite()
    {
        return $this->belongsTo(Favorite::class, 'favorite_id');
    }
}
