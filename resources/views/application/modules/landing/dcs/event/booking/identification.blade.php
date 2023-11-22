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
              <h1 class="title is-4">Payment Authorization</h1>
              @if(!Session::get('message'))
              <h6 class="has-background-info has-text-light">We Have Sent You The Code. Check Your Email</h6>
              <br>
              @endif
              <form class="row login_form" action="{{ route($hyperlink['page']['payment']) }}" method="POST" novalidate="novalidate">
                {{ csrf_field() }}
                <div class="field">
                  <label class="label">Payment Code</label>
                  <div class="control">
                    <input class="input" type="text" name="payment_code" placeholder="" value="">
                  </div>
                </div>
                <div class="field">
                  <div class="control">
                    <button class="button is-info is-fullwidth">Verify</button>
                    <a href="{{ route($hyperlink['page']['resent']) }}" class="button is-info is-fullwidth my-2">Resent Payment Code</a>
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
