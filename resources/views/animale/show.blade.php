@extends('layouts.main')

@push('styles')
    <link href="{{ asset('css/show.css') }}" rel="stylesheet">
@endpush

@section('content')
    <div class='container'>
        <h1>Detalii Animal</h1>
        <div class="box">
            <div class="image">
                @if($animal->image_path)
                    <img src="{{ asset('images/' . $animal->image_path) }}" alt="Imagine animal">
                @else
                    <img src="{{ asset('../images/no_photo.jpg') }}" alt="Imagine animal">
                @endif
            </div>
            <div class="details">
                <div class='title'>
                    <h3><strong>{{ $animal->tip }}</strong></h3>
                    <p><strong>Locație:</strong> {{ $animal->locatie }}</p>
                    <p><strong>Vârstă:</strong> {{ $animal->varsta }}</p>
                    <p><strong>Rasă:</strong> {{ $animal->rasa }}</p>
                    <p><strong>Culoare:</strong> {{ $animal->culoare }}</p>
                    <p><strong>Greutate:</strong> {{ $animal->greutate }}</p>
                    <p><strong>Vaccinat:</strong> {{ $animal->vaccinat }}</p>
                </div>   
                <p>{{ $animal->descriere }}</p>

                <div class="actions">
                    <a href="{{ route('animale.index') }}" class="btn btn-secondary">Înapoi la lista</a>
                </div>
            </div>
        </div>
    </div>
@endsection
