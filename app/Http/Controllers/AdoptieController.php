<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Animal;
use App\Models\Cerere;
use App\Mail\AdoptionMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;

class AdoptieController extends Controller
{
    public function create($animal_id)
    {
        $animal = Animal::findOrFail($animal_id);
        return view('adoptie.create', compact('animal'));
    }

    public function store(Request $request, $animal_id)
{
    $validatedData = $request->validate([
        'nume' => 'required|max:255',
        'prenume' => 'required|max:255',
        'adresa' => 'required|max:255',
        'telefon' => 'required|max:20',
        'motiv' => 'required|max:1000',
    ]);

    $cerere = new Cerere();
    $cerere->id_animal = $animal_id;
    $cerere->id_user = Auth::id();
    $cerere->nume = $request->nume;
    $cerere->prenume = $request->prenume;
    $cerere->telefon = $request->telefon;
    $cerere->status = 'În curs de procesare';
    $cerere->motiv = $request->motiv;
    $cerere->save();

    Mail::to('raluca.mocanu1414@gmail.com')->send(new AdoptionMail($validatedData));

    return redirect()->route('adoptie.create', ['animal_id' => $animal_id])->with('success', 'Cererea de adopție a fost trimisă.');
}


    public function index()
    {
        $user = Auth::user();
        $cereriTrimise = Cerere::where('id_user', $user->id)->with('animal')->get();
        $cereriPrimite = Cerere::whereHas('animal', function($query) use ($user) {
            $query->where('id_utilizator', $user->id);
        })->with(['animal', 'user'])->get();
    
        return view('adoptie.index', compact('cereriTrimise', 'cereriPrimite'));
    }
    

    public function anuleaza($cerere_id)
    {
        $cerere = Cerere::findOrFail($cerere_id);

        if (Auth::id() === $cerere->id_user && $cerere->status === 'În curs de procesare') {
            $cerere->delete();

            return redirect()->route('cereri.index')->with('success', 'Cererea de adopție a fost anulată.');
        }

        return redirect()->route('cereri.index')->with('error', 'Nu aveți permisiunea de a anula această cerere.');
    }

    public function accepta($cerere_id)
    {
        $cerere = Cerere::findOrFail($cerere_id);

        if (Auth::id() === $cerere->animal->id_utilizator) {
            $cerere->status = 'Urmează să fii contactat de către stăpân!';
            $cerere->save();

            return redirect()->route('cereri.index')->with('success', 'Cererea de adopție a fost acceptată.');
        }

        return redirect()->route('cereri.index')->with('error', 'Nu aveți permisiunea de a accepta această cerere.');
    }
}
