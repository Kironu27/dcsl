@extends(Config::get('routing.application.modules.dashboard.administrator.layout').'.structure.authorization')

@section('main-content')

<!-- section -->
<section class="login_box_area section_gap">

  <!-- container -->
  <div class="container">

    <!-- row -->
    <div class="row">

      <!-- col -->
      <div class="col-lg-6">
        <div class="login_box_img">
          <img class="img-fluid" src="{{ asset($asset['images'].'background.png') }}" alt="logo" style="height:500px">
          <div class="hover">
            <h4>Administrator Access</h4>
          </div>
        </div>
      </div>
      <!-- end col -->

      <!-- col -->
      <div class="col-lg-6">

        <!-- login form inner -->
        <div class="login_form_inner">

          <!-- title -->
          <h3>Log in to enter</h3>
          <!-- end title -->

          @if(Session::get('message'))
            <div class="alert alert-{{ ((Session::get('alert_type') == 'success')?'success':'danger') }}">
              {{ Session::get('message') }}
            </div>
          @endif

          @if($errors->any())
            <div class="alert alert-danger">
              <ul>
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          @endif

          <!-- form -->
          <form class="row login_form" action="{{ route($hyperlink['page']['process']) }}" method="POST" id="contactForm" novalidate="novalidate">

            <!-- email -->
            <div class="col-md-12 form-group">
              <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="administrator@gmail.com">
            </div>
            <!-- end email -->

            <!-- password -->
            <div class="col-md-12 form-group">
              <input type="password" class="form-control" id="password" name="password" placeholder="Password" value="123456">
            </div>
            <!-- end password -->

            <!-- control -->
            <div class="col-md-12 form-group">
              <button type="submit" value="submit" class="primary-btn">Log In</button>
              <a href="{{ route($hyperlink['navigation']['authorization']['administrator']['forgot']) }}">Forgot Password?</a>
            </div>
            <!-- end control -->

          </form>
          <!-- end form -->

        </div>
        <!-- end login form inner -->

      </div>
      <!-- end col -->

    </div>
    <!-- end row -->

  </div>
  <!-- end container -->

</section>
<!-- end section -->

@endsection
