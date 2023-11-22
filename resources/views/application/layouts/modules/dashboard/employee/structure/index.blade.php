<!DOCTYPE html>
<html lang="en">

<head>

  {{-- Favicon --}}
  @include(Config::get('routing.application.modules.landing.dcs.layout').'.header.favicon.index')

  {{-- Title --}}
  @include(Config::get('routing.application.modules.dashboard.employee.layout').'.header.title.index')

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

  {{-- Breadcrumb --}}
  @include(Config::get('routing.application.modules.landing.dcs.layout').'.navigation.header.breadcrumb')

  {{-- Main Content --}}
  @yield('main-content')

  {{-- JS --}}
  @include(Config::get('routing.application.modules.landing.dcs.layout').'.footer.js.index')

</body>

</html>
