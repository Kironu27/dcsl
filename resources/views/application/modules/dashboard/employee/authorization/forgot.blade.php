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

        <!-- columns -->
        <div class="columns is-centered">
          <div class="column is-4">
            <div class="box">
              <h1 class="title is-4">Employee Forgot Password</h1>
              <form class="row" action="{{ route($hyperlink['page']['process']) }}" method="POST" novalidate="novalidate">
                {{ csrf_field() }}
                <div class="field">
                  <label class="label">Email</label>
                  <div class="control">
                    <input class="input" type="email" name="email" placeholder="email">
                  </div>
                </div>
                <div class="field">
                  <div class="control">
                    <button class="button is-primary is-fullwidth">Submit</button>
                    <a href="{{ route($hyperlink['navigation']['authorization']['employee']['login']) }}"><small>Back to Sign In</small></a>
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
