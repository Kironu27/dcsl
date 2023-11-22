@extends(Config::get('routing.application.modules.landing.dcs.layout').'.structure.index')

@section('main-content')

  {{-- Login Option --}}
  @include($page['sub'].'.login_option')

@endsection
