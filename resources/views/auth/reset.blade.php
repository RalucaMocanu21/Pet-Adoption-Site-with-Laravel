@extends('layouts.main')

@push('styles')
    <link href="{{ asset('css/form.css') }}" rel="stylesheet">
@endpush

@section('content')
<div class="container">
    <h2>Resetează Parola</h2>
    <form method="POST" action="{{ route('password.update') }}">
        @csrf

        <div class="form-field">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" required>
        </div>

        <div class="form-field">
            <label for="password">Parolă nouă</label>
            <input type="password" id="password" name="password" required>
        </div>

        <div class="form-field">
            <label for="password_confirmation">Confirmare Parolă</label>
            <input type="password" id="password_confirmation" name="password_confirmation" required>
        </div>

        <div class="form-field">
            <button type="submit">Resetează Parola</button>
        </div>
    </form>
</div>
@endsection
