@extends(Config::get('routing.application.modules.dashboard.customer.layout').'.structure.authorization')

@section('main-content')

<!-- section -->
<section class="login_box_area section_gap">

  <!-- container -->
  <div class="container">

    <!-- column -->
    <div class="column">

      <!-- columns -->
      <div class="columns is-12 py-5">
        <div class="login_box_img">
          <img class="img-fluid" src="{{ asset($asset['images'].'background.png') }}" alt="">
          <div class="hover">
            <h4>Already Registered?</h4>
            <a class="primary-btn" href="{{ route($hyperlink['navigation']['authorization']['customer']['login']) }}">Click Here to Login</a>
          </div>
        </div>
      </div>
      <!-- end col -->

      <!-- columns -->
      <div class="columns is-12 py-5">

        <!-- login form inner -->
        <div class="login_form_inner">

          <!-- title -->
          <h3>Registration</h3>
          <!-- end title -->
          <br>

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

          <!-- form -->
          <form action="{{ route($hyperlink['page']['process']) }}" method="POST">
          {{ csrf_field() }}

            <!-- columns -->
            <div class="columns is-multiline">

              <!-- name -->
              <div class="input-group py-0 column is-12">
                <label for="name">Name</label>
                <input type="text" class="input" placeholder="Enter Name" name="name" value="{{ old('name') }}">
              </div>
              <!-- end name -->

              <!-- date of birth -->
              <div class="input-group py-0 column is-6">
                <label for="dob">Date of Birth</label>
                <input type="date" class="input" placeholder="Enter Date of Birth" name="dob" value="{{ old('dob') }}">
              </div>
              <!-- end date of birth -->

              <!-- gender -->
              <div class="input-group py-0 column is-6">
                <label for="gender">Gender</label>
                <select class="input" name="gender">
                  <option value="">--Please Select--</option>
                  <option value="male" {{ ((old('gender') == 'male')?'selected':'') }}>Male</option>
                  <option value="female" {{ ((old('gender') == 'female')?'selected':'') }}>Female</option>
                </select>
              </div>
              <!-- end gender -->

              <!-- email -->
              <div class="input-group py-0 column is-6">
                <label for="email">Email</label>
                <input type="text" class="input" placeholder="Enter Email" name="email" value="{{ old('email') }}">
              </div>
              <!-- end email -->

              <!-- contact -->
              <div class="input-group py-0 column is-6">
                <label for="contact_no">Contact</label>
                <input type="text" class="input" placeholder="Enter Contact No" name="contact_no" value="{{ old('contact_no') }}">
              </div>
              <!-- end contact -->

              <!-- password -->
              <div class="input-group py-0 column is-6">
                <label for="password">Password</label>
                <input type="password" class="input" placeholder="Enter Password" name="password" value="">
              </div>
              <!-- end password -->

              <!-- password confirmation -->
              <div class="input-group py-0 column is-6">
                <label for="password_confirmation">Password Confirmation</label>
                <input type="password" class="input" placeholder="Enter Password Confirmation" name="password_confirmation" value="">
              </div>
              <!-- end password confirmation -->

              <!-- control -->
              <div class="input-group py-0 column is-12 has-text-centered">
                <input type="hidden" name="id" value="{{ Auth::guard(Session::get('guard'))->id() }}">
                <button type="submit" class="button is-link" name="submit">Register</button>
              </div>
              <!-- end control -->

            </div>
            <!-- end columns -->

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
