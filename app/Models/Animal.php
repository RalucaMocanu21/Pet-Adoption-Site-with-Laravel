<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;

class Animal extends Model
{
    use HasFactory;
    
    protected $table = 'animale'; 
    protected $primaryKey = 'animal_id';
     
    protected $fillable = [
        'nume', 'tip', 'descriere', 'varsta', 'rasa', 'culoare', 'greutate', 'vaccinat', 'image_path', 'locatie', 'id_utilizator'
    ];

    public function owner()
    {
        return $this->belongsTo(User::class, 'id_utilizator');
    }

    public function favorites()
    {
        return $this->hasMany(Favorite::class, 'animal_id');
    }
    public function cereri()
    {
        return $this->hasMany(Cerere::class, 'id_animal', 'animal_id');
    }
}