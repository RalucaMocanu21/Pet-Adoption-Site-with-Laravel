@extends('layouts.main')

@push('styles')
    <link href="{{ asset('css/statistici.css') }}" rel="stylesheet">
@endpush

@section('content')
    <div class="container">
        <h2>Statistici Postări Utilizatori</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Nume Utilizator</th>
                    <th>Adresa de e-mail</th>
                    <th>Număr Animale Postate</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($utilizatori as $utilizator)
                    <tr>
                        <td>{{ $utilizator->username }}</td>
                        <td>{{ $utilizator->email }}</td>
                        <td>{{ $utilizator->animale_count }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection