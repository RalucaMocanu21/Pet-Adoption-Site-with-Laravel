@extends('layouts.main')

@push('styles')
    <link href="{{ asset('css/adoptie.css') }}" rel="stylesheet">
@endpush

@section('content')

<div class='container'>
    <h1>Cererile Mele de Adopție</h1>
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

    @if(!$cereriTrimise->isEmpty())
        <div class="section">
            <h3>Cererile trimise de mine</h3>
            <div class="animals">
                @foreach ($cereriTrimise as $cerere)
                    <div class='animal'>
                        <div class='details'>
                            <div class='title'>
                                <h3>{{ $cerere->animal->tip }}</h3>
                                <p><strong>Locație:</strong> {{ $cerere->animal->locatie }}</p>
                                <p><strong>Vârstă:</strong> {{ $cerere->animal->varsta }}</p>
                                <p><strong>Rasă:</strong> {{ $cerere->animal->rasa }}</p>
                                <p><strong>Culoare:</strong> {{ $cerere->animal->culoare }}</p>
                                <p><strong>Greutate:</strong> {{ $cerere->animal->greutate }}</p>
                                <p><strong>Vaccinat:</strong> {{ $cerere->animal->vaccinat }}</p>
                                <p><strong>Status:</strong> {{ $cerere->status }}</p>
                            </div>
                            <div class='description'>
                                <p>{{ $cerere->animal->descriere }}</p>
                            </div>
                            <div class="image">
                                @if($cerere->animal->image_path)
                                    <img src="{{ asset('images/' . $cerere->animal->image_path) }}" alt="Imagine animal">
                                @else
                                    <img src="{{ asset('images/no_photo.jpg') }}" alt="Imagine animal">
                                @endif
                            </div>
                            @if ($cerere->status === 'În curs de procesare')
                                <div class='actions'>
                                    <form method="POST" action="{{ route('cereri.anuleaza', ['cerere_id' => $cerere->cerere_id]) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Sigur doriți să anulați această cerere?')">Anulează cererea</button>
                                    </form>
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    @if(!$cereriPrimite->isEmpty())
        <div class="section">
            <h3>Cererile primite pentru animalele mele</h3>
            <div class="animals">
                @foreach ($cereriPrimite as $cerere)
                    <div class='animal'>
                        <div class='details'>
                            <div class='title'>
                                <h3>{{ $cerere->animal->tip }}</h3>
                                <p><strong>Locație:</strong> {{ $cerere->animal->locatie }}</p>
                                <p><strong>Vârstă:</strong> {{ $cerere->animal->varsta }}</p>
                                <p><strong>Rasă:</strong> {{ $cerere->animal->rasa }}</p>
                                <p><strong>Culoare:</strong> {{ $cerere->animal->culoare }}</p>
                                <p><strong>Greutate:</strong> {{ $cerere->animal->greutate }}</p>
                                <p><strong>Vaccinat:</strong> {{ $cerere->animal->vaccinat }}</p>
                                <p><strong>Status:</strong> {{ $cerere->status }}</p>
                                <p><strong>Nume Adoptant:</strong> {{ $cerere->nume }} {{ $cerere->prenume }}</p>
                                <p><strong>Telefon Adoptant:</strong> {{ $cerere->telefon }}</p>
                                <p><strong>Motivul adopției:</strong> {{ $cerere->motiv }}</p>
                            </div>
                            <div class='description'>
                                <p>{{ $cerere->animal->descriere }}</p>
                            </div>
                            <div class="image">
                                @if($cerere->animal->image_path)
                                    <img src="{{ asset('images/' . $cerere->animal->image_path) }}" alt="Imagine animal">
                                @else
                                    <img src="{{ asset('images/no_photo.jpg') }}" alt="Imagine animal">
                                @endif
                            </div>
                            @if ($cerere->status === 'În curs de procesare')
                                <div class='actions'>
                                    <form method="POST" action="{{ route('cereri.accepta', ['cerere_id' => $cerere->cerere_id]) }}">
                                        @csrf
                                        <button type="submit" class="btn btn-primary">Acceptă cererea de adopție</button>
                                    </form>
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    @if($cereriTrimise->isEmpty() && $cereriPrimite->isEmpty())
        <p>Nu există cereri de adopție trimise sau primite.</p>
    @endif
</div>

@endsection

