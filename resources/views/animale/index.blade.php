@extends('layouts.main')

@push('styles')
    <link href="{{ asset('css/animals.css') }}" rel="stylesheet">
@endpush

@section('content')

<div class='container'>
    <div class="line">
        <h1>Animale Disponibile</h1>
     
        @if(session()->has('success'))
            <div class="alert alert-success">
                {{ session()->get('success') }}
            </div>
        @endif

        @if(session()->has('error'))
            <div class="alert alert-danger">
                {{ session()->get('error') }}
            </div>
        @endif
    </div>

    <form action="{{ route('animale.filter') }}" method="GET">
        <div class="form-group">
            <label for="tip">Filtrează după tip:</label>
            <select name="tip" id="tip" class="form-control">
                <option value="" {{ request('tip') == '' ? 'selected' : '' }}>Toate</option>
                <option value="Câine" {{ request('tip') == 'Câine' ? 'selected' : '' }}>Câine</option>
                <option value="Pisică" {{ request('tip') == 'Pisică' ? 'selected' : '' }}>Pisică</option>
            </select>
        </div>
        <div class="form-group">
            <label for="sort">Sortare:</label>
            <select name="sort" id="sort" class="form-control">
                <option value="recent" {{ request('sort') == 'recent' ? 'selected' : '' }}>Cele mai recente</option>
                <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Cele mai vechi</option>
            </select>
        </div>
        <button type="submit" class="button btn btn-sm">Aplică filtre</button>
    </form>
    <div class="add-animal">
        @if (Auth::check() && Auth::user()->hasRole('client'))   
            <a href="{{ route('animale.create') }}" class="button">Adăugare animal nou</a>
        @endif
    </div>

    <div class="animals">
        @if ($animale->isEmpty())
            <p>Nu există animale disponibile.</p>
        @else
            @foreach ($animale as $animal)
                <div class='animal'>
                    <div class="image">
                        @if($animal->image_path)
                            <img src="{{ asset('images/' . $animal->image_path) }}" alt="Imagine animal">
                        @else
                            <img src="{{ asset('images/no_photo.jpg') }}" alt="Imagine animal">
                        @endif
                    </div>
                    <div class='details'>
                        <h3>{{ $animal->tip }}</h3>
                        <p><strong>Locație:</strong> {{ $animal->locatie }}</p>
                        <p><strong></strong> {{ $animal->descriere }}</p>
                    </div>
                    <div class='actions'>
                        <a href="{{ route('animale.show', ['animal_id' => $animal->animal_id]) }}" class="btn btn-info">Vezi detalii</a>
                        @if (Auth::check() && Auth::user()->hasRole('client'))
                            <form method="POST" action="{{ route('favorite.adaugaLaFavorite', ['animal_id' => $animal->animal_id]) }}" style="display: inline-block;">
                                @csrf
                                <button type="submit" class="btn btn-primary">Adaugă la Favorite</button>
                            </form>
                        @endif
                        @if (Auth::check() && (Auth::id() == $animal->id_utilizator || Auth::user()->isAdmin()))
                            <a href="{{ route('animale.edit', ['animal_id' => $animal->animal_id]) }}" class='btn btn-secondary btn-sm'>Editează</a>
                            <form action="{{ route('animale.destroy', ['animal_id' => $animal->animal_id]) }}" method="POST" style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class='btn btn-danger btn-sm' onclick="return confirm('Sigur doriți să ștergeți acest animal?')">Șterge</button>
                            </form>
                        @else
                            <a href="{{ route('adoptie.create', ['animal_id' => $animal->animal_id]) }}" class="btn btn-success">Adoptă acum</a>
                        @endif
                    </div>
                </div>
            @endforeach
        @endif
    </div>
</div>

@endsection

