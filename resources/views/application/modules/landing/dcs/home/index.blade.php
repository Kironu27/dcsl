@extends(Config::get('routing.application.modules.landing.dcs.layout').'.structure.index')

@section('main-content')

  {{-- Banner --}}
  @include($page['sub'].'.banner')

  {{-- Booking --}}
  @include($page['sub'].'.booking')

@endsection
