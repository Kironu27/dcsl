@extends(Config::get('routing.application.modules.landing.dcs.layout').'.structure.index')

@section('main-content')

  {{-- Information --}}
  @include($page['sub'].'.information')

@endsection
