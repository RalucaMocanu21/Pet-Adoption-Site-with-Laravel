<?php

namespace App\Http\Controllers;

use App\Models\Animal;
use Illuminate\Http\Request;
use  App\Models\User;
use App\Mail\NewAnimalPostedMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class AnimaleController extends Controller
{
    public function index()
{
    $currentUserId = Auth::id(); 
   
    $userAnimals = Animal::where('id_utilizator', $currentUserId)->orderBy('created_at', 'desc')->get();

   
    $otherAnimals = Animal::where('id_utilizator', '!=', $currentUserId)->orderBy('created_at', 'desc')->get();

    $animale = $userAnimals->merge($otherAnimals);

    return view('animale.index', compact('animale'));
}

    public function create()
    {
        return view('animale.create');
    }

    public function store(Request $request)
{
    $validatedData = $request->validate([
        'tip' => 'required|in:Câine,Pisică',
        'descriere' => 'required',
        'varsta' => 'required|integer|min:0',
        'culoare' => 'required|max:255',
        'rasa' => 'required|max:255',
        'greutate' => 'required|numeric|min:0',
        'vaccinat' => 'required|in:Da,Nu',
        'image_path' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        'locatie' => 'required|max:255'
    ]);

    if ($request->hasFile('image_path')) {
        $image = $request->file('image_path');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('images'), $imageName);
        $validatedData['image_path'] = $imageName;  
    }

    $validatedData['id_utilizator'] = auth()->id();

    $animal= Animal::create($validatedData);

    Mail::to('raluca.mocanu1414@gmail.com')->send(new NewAnimalPostedMail($animal));


    return redirect()->route('animale.index')
        ->with('success', 'Animalul a fost adăugat cu succes!');
}

    public function show($animal_id)
    {
        $animal = Animal::findOrFail($animal_id);
        return view('animale.show', compact('animal'));
    }

    public function edit($animal_id)
{
    $animal = Animal::findOrFail($animal_id);

    if (Auth::user()->isAdmin() || Auth::id() === $animal->id_utilizator) {
        return view('animale.edit', compact('animal'));
    }

    return redirect()->route('animale.index')->with('error', 'Nu aveți permisiunea de a edita acest animal!');
}

public function update(Request $request, $animal_id)
{
    $animal = Animal::findOrFail($animal_id);

    if (auth()->user()->isAdmin() || auth()->id() === $animal->id_utilizator) {
        $validatedData = $request->validate([
            'tip' => 'required|in:Câine,Pisică',
            'descriere' => 'required',
            'varsta' => 'required|integer|min:0',
            'culoare' => 'required|max:255',
            'rasa' => 'required|max:255',
            'greutate' => 'required|numeric|min:0',
            'vaccinat' => 'required|in:Da,Nu',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'locatie' => 'required|max:255'
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $validatedData['image_path'] = $imageName;
        }

        $animal->update($validatedData);

        return redirect()->route('animale.index')
            ->with('success', 'Animalul a fost actualizat cu succes!');
    }

    return redirect()->route('animale.index')->with('error', 'Nu aveți permisiunea de a actualiza acest animal!');
}



public function destroy($animal_id)
{
    $animal = Animal::findOrFail($animal_id);

    if (Auth::user()->isAdmin() || Auth::id() === $animal->id_utilizator) {
        \DB::table('favorite')->where('animal_id', $animal_id)->delete();

        $animal->delete();

        return redirect()->route('animale.index')
            ->with('success', 'Animalul a fost șters cu succes!');
    }

    return redirect()->route('animale.index')->with('error', 'Nu aveți permisiunea de a șterge acest animal!');
}


public function filter(Request $request)
{
    $query = Animal::query();

    if ($request->has('tip') && $request->tip != '') {
        $query->where('tip', $request->tip);
    }

    if ($request->has('sort') && $request->sort != '') {
        if ($request->sort == 'recent') {
            $query->orderBy('created_at', 'desc');
        } elseif ($request->sort == 'oldest') {
            $query->orderBy('created_at', 'asc');
        }
    }

    $animale = $query->get();

    return view('animale.index', compact('animale'));
}
}