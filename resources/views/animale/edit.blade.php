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

    <form method="POST" action="{{ route('animale.update', ['animal_id' => $animal->animal_id]) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        @if($animal->image_path)
            <img src="{{ asset('images/' . $animal->image_path) }}" alt="Imagine animal" width="200">
        @else
            <p>Nici o imagine încărcată.</p>
        @endif

        <div class="form-field">
            <label for="image" class="form-label">Schimbați imaginea animalului:</label>
            <input type="file" name="image" accept="image/*" class="form-control mb-2" >
        </div>

        <div class="form-field">
            <label for="tip">Tipul animalului:</label>
            <select id="tip" name="tip" class="form-control" required>
                <option value="Câine" {{ $animal->tip == 'Câine' ? 'selected' : '' }}>Câine</option>
                <option value="Pisică" {{ $animal->tip == 'Pisică' ? 'selected' : '' }}>Pisică</option>
            </select>
        </div>

        <div class="form-field">
            <label for="locatie">Locație:</label>
            <input type="text" id="locatie" name="locatie" class="form-control" value="{{ $animal->locatie }}" required>
        </div>

        <div class="form-field">
            <label for="descriere">Descriere:</label>
            <textarea id="descriere" name="descriere" class="form-control" required>{{ $animal->descriere }}</textarea>
        </div>

        <div class="form-field">
            <label for="varsta">Vârsta animalului:</label>
            <input type="number" id="varsta" name="varsta" class="form-control" value="{{ $animal->varsta }}" required min="0">
        </div>

        <div class="form-field">
            <label for="culoare">Culoare:</label>
            <input type="text" id="culoare" name="culoare" class="form-control" value="{{ $animal->culoare }}" required maxlength="255">
        </div>

        <div class="form-field">
            <label for="rasa">Rasă:</label>
            <input type="text" id="rasa" name="rasa" class="form-control" value="{{ $animal->rasa }}" required maxlength="255">
        </div>

        <div class="form-field">
            <label for="greutate">Greutate:</label>
            <input type="number" id="greutate" name="greutate" class="form-control" value="{{ $animal->greutate }}" required min="0" step="0.01">
        </div>

        <div class="form-field">
            <label for="vaccinat">Vaccinat:</label>
            <select name="vaccinat" id="vaccinat" class="form-control">
                <option value="Da" {{ $animal->vaccinat === 'Da' ? 'selected' : '' }}>Da</option>
                <option value="Nu" {{ $animal->vaccinat === 'Nu' ? 'selected' : '' }}>Nu</option>
            </select>
        </div>

        <br>

        <button type="submit" class="btn btn-primary">Actualizare Animal</button>
    </form>

    <script>
        function loadPreview(input) {
            const preview = document.getElementById('preview');
            const file = input.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                };
                reader.readAsDataURL(file);
            } else {
                preview.src = '';
                preview.style.display = 'none';
            }
        }
    </script>
@endsection

