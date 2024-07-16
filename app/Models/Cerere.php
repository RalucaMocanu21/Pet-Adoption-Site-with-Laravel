<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cerere extends Model
{
    use HasFactory;

    protected $table = 'cereri';
    protected $primaryKey = 'cerere_id';

    protected $fillable = [
        'id_animal',
        'id_user',
        'status',
        'motiv',
    ];

    public function animal()
    {
        return $this->belongsTo(Animal::class, 'id_animal');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
