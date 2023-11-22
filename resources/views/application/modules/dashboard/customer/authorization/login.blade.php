@extends(Config::get('routing.application.modules.dashboard.customer.layout').'.structure.authorization')

@section('main-content')

<!-- section -->
<section>

  <!-- hero -->
  <div class="hero">

    <!-- hero body -->
    <div class="hero-body">

      <!-- container -->
      <div class="container">

        @if(Session::get('message'))
          <div class="notification {{ ((Session::get('alert_type') == 'success')?'has-text-primary':'has-text-danger') }}">
            {{ Session::get('message') }}
          </div>
        @endif

        @if($errors->any())
          <div class="notification has-text-danger">
            <ul>
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif

        <!-- columns -->
        <div class="columns is-centered">
          <div class="column is-4">
            <div class="box">
              <h1 class="title is-4">Customer Login</h1>
              <form class="row login_form" action="{{ route($hyperlink['page']['process']) }}" method="POST" novalidate="novalidate">
                {{ csrf_field() }}
                <div class="field">
                  <label class="label">Email</label>
                  <div class="control">
                    <input class="input" type="email" name="email" placeholder="email" value="sophia@gmail.com">
                  </div>
                </div>
                <div class="field">
                  <label class="label">Password</label>
                  <div class="control">
                    <input class="input" type="password" name="password" placeholder="Password" value="123456">
                  </div>
                </div>
                <div class="field">
                  <div class="control">
                    <input type="hidden" name="authorization_token" value="{{ $authorization_token['guard'] }}">
                    @if(Session::get('form_redirect'))
                    <input type="hidden" name="redirect" value="{{ Session::get('form_redirect') }}">
                    @endif
                    <button class="button is-primary is-fullwidth">Login</button>
                    <a href="{{ route($hyperlink['navigation']['authorization']['customer']['register']) }}"><small>New User</small></a> |
                    <a href="{{ route($hyperlink['navigation']['authorization']['customer']['forgot']) }}"><small>Forgot Password?</small></a>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
        <!-- end columns -->

      </div>
      <!-- end container -->

    </div>
    <!-- end hero body -->

  </div>
  <!-- end hero -->

</section>
<!-- end section -->

@endsection
