@extends('layouts.main')

@push('styles')
    <link href="{{ asset('css/form.css') }}" rel="stylesheet">
@endpush

@section('content')
    <div class='container'>
        <h2>Formular de Adopție</h2>
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

        <form method="POST" action="{{ route('adoptie.store', ['animal_id' => $animal->animal_id]) }}">
            @csrf
            <div class="form-group">
                <label for="nume">Nume:</label>
                <input type="text" name="nume" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="prenume">Prenume:</label>
                <input type="text" name="prenume" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="adresa">Adresa:</label>
                <input type="text" name="adresa" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="telefon">Telefon:</label>
                <input type="text" name="telefon" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="motiv">De ce crezi că ai fi un bun stăpân pentru acest animăluț?</label>
                <textarea name="motiv" id="motiv" class="form-control" rows="4" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Trimite Formular</button>
        </form>
    </div>
@endsection
