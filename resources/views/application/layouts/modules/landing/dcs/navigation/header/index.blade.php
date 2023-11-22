<!-- navigation -->
<nav class="navigation navbar is-fixed-top is-align-items-center is-transparent" role="navigation" aria-label="main navigation">

  <!-- container -->
  <div class="container">

    <!-- navbar brand -->
    <div class="navbar-brand">
      <a class="navbar-item" href="{{ route($hyperlink['navigation']['header']['home']) }}">
        <img class="img-fluid" src="{{ asset('images\logo\logo_with_text.png') }}" alt="Daimon Sports Center">
      </a>

      <a role="button" class="navbar-burger burger mt-2" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
        <span aria-hidden="true"></span>
        <span aria-hidden="true"></span>
        <span aria-hidden="true"></span>
      </a>
    </div>
    <!-- end navbar brand -->

    <!-- navbar menu -->
    <div id="navbarBasicExample" class="navbar-menu">

      <!-- navbar start -->
      <div class="navbar-start mx-auto">

        <div class="navbar-item">
          <a href="{{ route($hyperlink['navigation']['header']['home']) }}" class="navbar-link is-arrowless">HOME</a>
        </div>

        <div class="navbar-item">
          <a href="{{ route($hyperlink['navigation']['header']['about']) }}" class="navbar-link is-arrowless">ABOUT</a>
        </div>

        <div class="navbar-item">
          <a href="{{ route($hyperlink['navigation']['header']['contact']) }}" class="navbar-link is-arrowless">CONTACT</a>
        </div>

      </div>
      <!-- end navbar start -->

      <!-- navbar end -->
      <div class="navbar-end is-align-items-center ml-0">

        @if(Auth::guard('employee')->check())


              <div class="navbar-item">
                <i class="ti-home"></i>
                <a href="{{ route($hyperlink['navigation']['authorization']['employee']['home']) }}" class="navbar-link is-arrowless">Dashboard</a>
              </div>
              <div class="navbar-item has-dropdown is-hoverable">
                <a class="navbar-link">
                  Account
                </a>
                <div class="navbar-dropdown">
                  <a href="{{ route($hyperlink['navigation']['authorization']['employee']['header']['account']['avatar']) }}" class="navbar-item">Avatar</a>
                  <a href="{{ route($hyperlink['navigation']['authorization']['employee']['header']['account']['profile']) }}" class="navbar-item">My Profile</a>
                  <a href="{{ route($hyperlink['navigation']['authorization']['employee']['header']['account']['change_password']) }}" class="navbar-item">Change Password</a>
                  <a href="{{ route($hyperlink['navigation']['authorization']['employee']['header']['account']['logout']) }}" class="navbar-item">Logout</a>
                </div>
              </div>

        @else

          @if(Auth::guard('customer')->check())

            <div class="navbar-item">
              <i class="ti-home"></i>
              <a href="{{ route($hyperlink['navigation']['authorization']['customer']['home']) }}" class="navbar-link is-arrowless">Dashboard</a>
            </div>
            <div class="navbar-item has-dropdown is-hoverable">
              <a class="navbar-link">
                Account
              </a>
              <div class="navbar-dropdown">
                <a href="{{ route($hyperlink['navigation']['authorization']['customer']['header']['account']['avatar']) }}" class="navbar-item">Avatar</a>
                <a href="{{ route($hyperlink['navigation']['authorization']['customer']['header']['account']['profile']) }}" class="navbar-item">My Profile</a>
                <a href="{{ route($hyperlink['navigation']['authorization']['customer']['header']['account']['change_password']) }}" class="navbar-item">Change Password</a>
                <a href="{{ route($hyperlink['navigation']['authorization']['customer']['header']['account']['logout']) }}" class="navbar-item">Logout</a>
              </div>
            </div>

          @else

            <div class="navbar-item">
              <i class="ti-user"></i>
              <a href="{{ route($hyperlink['navigation']['header']['login_option']) }}" class="navbar-link is-arrowless">LOGIN</a>
            </div>
            <div class="navbar-item">
              <a href="{{ route($hyperlink['navigation']['header']['register']) }}" class="navbar-link is-arrowless" >REGISTER</a>
            </div>


          @endif

        @endif

      </div>
      <!-- end navbar end -->

    </div>
    <!-- navbar menu -->

  </div>
  <!-- end container -->

</nav>
<!-- end navigation -->
