<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Animal;
use App\Models\Favorite;
use App\Models\UserFavorite;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $favorites = UserFavorite::where('user_id', $user->id)->with('favorite.animal')->get();
        return view('favorite.index', compact('favorites'));
    }

    public function adaugaLaFavorite($animal_id)
    {
        $user = Auth::user();
        $favorite = Favorite::firstOrCreate(['animal_id' => $animal_id]);
        UserFavorite::firstOrCreate([
            'user_id' => $user->id,
            'favorite_id' => $favorite->id_favorite
        ]);

        return redirect()->back()->with('success', 'Animalul a fost adăugat la favorite.');
    }

    public function stergeDinFavorite($animal_id)
    {
        $user = Auth::user();
        $favorite = Favorite::where('animal_id', $animal_id)->first();

        if ($favorite) {
            UserFavorite::where('user_id', $user->id)
                        ->where('favorite_id', $favorite->id_favorite)
                        ->delete();
        }

        return redirect()->back()->with('success', 'Animalul a fost șters din favorite.');
    }
}
