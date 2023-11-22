<!DOCTYPE html>
<html lang="en">

<head>

  {{-- Favicon --}}
  @include(Config::get('routing.application.modules.landing.dcs.layout').'.header.favicon.index')

  {{-- Title --}}
  @include(Config::get('routing.application.modules.landing.dcs.layout').'.header.title.index')

  {{-- Meta --}}
  @include(Config::get('routing.application.modules.landing.dcs.layout').'.header.meta.index')

  {{-- CSS --}}
  @include(Config::get('routing.application.modules.landing.dcs.layout').'.header.css.index')

  {{-- JS --}}
  @include(Config::get('routing.application.modules.landing.dcs.layout').'.header.js.index')

</head>

<body>

  {{-- Navigation Header --}}
  @include(Config::get('routing.application.modules.landing.dcs.layout').'.navigation.header.index')

  @if(Route::currentRouteName() != 'application.modules.landing.dcs.home')

    {{-- Breadcrumb --}}
    @include(Config::get('routing.application.modules.landing.dcs.layout').'.navigation.header.breadcrumb')

  @endif

  {{-- Main Content --}}
  @yield('main-content')

  {{-- Footer
  @include(Config::get('routing.application.modules.landing.dcs.layout').'.footer.content.index') --}}

  {{-- JS --}}
  @include(Config::get('routing.application.modules.landing.dcs.layout').'.footer.js.index')

</body>

</html>
