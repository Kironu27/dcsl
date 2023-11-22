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
              <h1 class="title is-4">Verification Authorization</h1>
              <form class="row login_form" action="{{ route($hyperlink['page']['process']) }}" method="POST" novalidate="novalidate">
                {{ csrf_field() }}
                <div class="field">
                  <label class="label">Verification Code</label>
                  <div class="control">
                    <input class="input" type="email" name="verification_code" placeholder="" value="">
                  </div>
                </div>
                <div class="field">
                  <div class="control">
                    <input type="hidden" name="authorization_token" value="{{ $authorization_token['guard'] }}">
                    <input type="hidden" name="id" value="{{ Session::get('temporary_user_id') }}">
                    <button class="button is-primary is-fullwidth">Verify</button>
                    <a href="{{ route($hyperlink['page']['resent'],['id'=>Session::get('temporary_user_id')]) }}" class="button is-primary is-fullwidth my-2">Resent Verification Code</a>
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
