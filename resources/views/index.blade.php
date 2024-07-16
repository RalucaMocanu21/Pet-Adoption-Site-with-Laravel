@extends ("layouts/main")

@push('styles')
  <link href="{{ asset('css/index.css') }}" rel="stylesheet">
@endpush

@section('content')
  <div class="welcome-text">
    <div class="text-container">
    <div class="text">
      <h3> Bun venit la </h3>
      <a href="/">PetAdopt</a>
    </div>
    <div class="bttn">
      <a href="{{ route('animale.index') }}" class="button">Animale disponibile</a>
    </div>
    </div>
    
  </div>
@stop

