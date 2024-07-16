@extends('layouts.main')

@push('styles')
    <link href="{{ asset('css/statistici.css') }}" rel="stylesheet">
@endpush

@section('content')
    <div class='container'>
        <h2>Statistici Cereri de Adopție</h2>
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

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nume Utilizator</th>
                    <th>Adresa de e-mail</th>
                    <th>Număr Cereri de Adopție</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($statistici as $statistic)
                    <tr>
                        <td>{{ $statistic->username }}</td>
                        <td>{{ $statistic->email }}</td>
                        <td>{{ $statistic->cereri_count }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
