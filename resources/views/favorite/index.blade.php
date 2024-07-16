@extends('layouts.main')

@push('styles')
    <link href="{{ asset('css/animals.css') }}" rel="stylesheet">
@endpush

@section('content')

<div class='container'>
    <h1>Animalele Favorite</h1>
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

    <div class="animals">
        @if ($favorites->isEmpty())
            <p>Nu există animale favorite.</p>
        @else
            @foreach ($favorites as $userFavorite)
                <div class='animal'>
                    <div class='details'>
                        <div class='title'>
                            <h3>{{ $userFavorite->favorite->animal->tip }}</h3>
                            <p><strong>Locație:</strong> {{ $userFavorite->favorite->animal->locatie }}</p>
                            <p><strong>Vârstă:</strong> {{ $userFavorite->favorite->animal->varsta }}</p>
                            <p><strong>Rasă:</strong> {{ $userFavorite->favorite->animal->rasa }}</p>
                            <p><strong>Culoare:</strong> {{ $userFavorite->favorite->animal->culoare }}</p>
                            <p><strong>Greutate:</strong> {{ $userFavorite->favorite->animal->greutate }}</p>
                            <p><strong>Vaccinat:</strong> {{ $userFavorite->favorite->animal->vaccinat }}</p>
                        </div>
                        <div class='description'>
                            <p>{{ $userFavorite->favorite->animal->descriere }}</p>
                        </div>
                        <div class="image">
                            @if($userFavorite->favorite->animal->image_path)
                                <img src="{{ asset('images/' . $userFavorite->favorite->animal->image_path) }}" alt="Imagine animal">
                            @else
                                <img src="{{ asset('../images/no_photo.jpg') }}" alt="Imagine animal">
                            @endif
                        </div>
                        <div class='actions'>
                            <form method="POST" action="{{ route('favorite.stergeDinFavorite', ['animal_id' => $userFavorite->favorite->animal->animal_id]) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Șterge din Favorite</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
</div>

@endsection
