@extends('layouts.main')

@push('styles')
    <link href="{{ asset('css/form.css') }}" rel="stylesheet">
@endpush

@section('content')
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

    <form method="POST" action="{{ route('animale.store') }}" enctype="multipart/form-data">
        @csrf

        <div class="form-field">
            <label for="image_path" class="form-label">Încărcați imaginea animalului:</label>
            <input type="file" name="image_path" accept="image/*" class="form-control mb-2">
        </div>

        <div class="form-field">
            <label for="tip">Tip animal:</label>
            <select name="tip" id="tip" class="form-control">
                <option value="Câine">Câine</option>
                <option value="Pisică">Pisică</option>
            </select>
        </div>

        <div class="form-field">
            <label for="descriere">Descriere:</label>
            <textarea id="descriere" name="descriere" class="form-control" required></textarea>
        </div>

        <div class="form-field">
            <label for="locatie">Locație:</label>
            <input type="text" id="locatie" name="locatie" class="form-control" required>
        </div>

        <div class="form-field">
            <label for="varsta">Vârsta animalului:</label>
            <input type="number" id="varsta" name="varsta" class="form-control" required min="0">
        </div>

        <div class="form-field">
            <label for="culoare">Culoare:</label>
            <input type="text" id="culoare" name="culoare" class="form-control" required maxlength="255">
        </div>

        <div class="form-field">
            <label for="rasa">Rasă:</label>
            <input type="text" id="rasa" name="rasa" class="form-control" required maxlength="255">
        </div>

        <div class="form-field">
            <label for="greutate">Greutate:</label>
            <input type="number" id="greutate" name="greutate" class="form-control" required min="0" step="0.01">
        </div>

        <div class="form-field">
            <label for="vaccinat">Vaccinat:</label>
            <select name="vaccinat" id="vaccinat" class="form-control">
                <option value="Da">Da</option>
                <option value="Nu">Nu</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Adaugă Animal</button>
    </form>
@endsection
