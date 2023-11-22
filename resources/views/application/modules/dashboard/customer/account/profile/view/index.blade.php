@extends(Config::get('routing.application.modules.dashboard.customer.layout').'.structure.index')

@section('main-content')

<!-- summary -->
<section class="features-area py-5">

	<!-- container -->
	<div class="container py-5">

	  <!-- columns -->
	  <div class="columns is-multiline is-desktop is-justify-content-center">

			{{-- Panel Sidebar --}}
			@include(Config::get('routing.application.modules.dashboard.customer.layout').'.navigation.panel.index')

			<!-- column -->
      <div class="column is-8-desktop mb-5 sidebar-home">

				<!-- columns -->
				<div class="columns">

					<div class="column is-full">

						@if(Session::get('message'))
							<div class="notification {{ ((Session::get('alert_type') == 'success')?'is-primary':'is-danger') }}">
								{{ Session::get('message') }}
							</div>
						@endif

						@if($errors->any())
							<div class="notification is-danger">
								<ul>
									@foreach ($errors->all() as $error)
										<li>{{ $error }}</li>
									@endforeach
								</ul>
							</div>
						@endif

						<div class="widget widget-about">
							<h3 class="has-text-left">My Account</h3>

							<div class="columns pt-5 mt-5">

								<div class="column is-full pricing-item">
									<!-- form -->
				          <form action="{{ route($hyperlink['page']['update']) }}" method="POST">
									{{ csrf_field() }}

										<!-- columns -->
										<div class="columns is-multiline">

											<!-- name -->
											<div class="input-group py-0 column is-6">
												<label for="name">Name</label>
												<input type="text" class="input" placeholder="Enter Name" name="name" value="{{ Auth::guard(Session::get('guard'))->user()->name }}">
											</div>
											<!-- end name -->

											<!-- date of birth -->
											<div class="input-group py-0 column is-6">
												<label for="dob">Date of Birth</label>
												<input type="date" class="input" placeholder="Enter Date of Birth" name="dob" value="{{ Auth::guard(Session::get('guard'))->user()->dob }}">
											</div>
											<!-- end date of birth -->

											<!-- gender -->
											<div class="input-group py-0 column is-6">
												<label for="gender">Gender</label>
												<select class="input" name="gender">
													<option value="">--Please Select--</option>
													<option value="male" {{ ((Auth::guard(Session::get('guard'))->user()->gender == 'male')?'selected':'') }}>Male</option>
													<option value="female" {{ ((Auth::guard(Session::get('guard'))->user()->gender == 'female')?'selected':'') }}>Female</option>
												</select>
											</div>
											<!-- end gender -->

											<!-- email -->
											<div class="input-group py-0 column is-6">
												<label for="email">Email</label>
												<input type="text" class="input" placeholder="Enter Email" name="email" value="{{ Auth::guard(Session::get('guard'))->user()->email }}">
											</div>
											<!-- end email -->

											<!-- contact -->
											<div class="input-group py-0 column is-6">
												<label for="contact_no">Contact</label>
												<input type="text" class="input" placeholder="Enter Contact No" name="contact_no" value="{{ Auth::guard(Session::get('guard'))->user()->contact_no }}">
											</div>
											<!-- end contact -->

											<!-- control -->
											<div class="input-group py-0 column is-12 has-text-centered">
												<input type="hidden" name="id" value="{{ Auth::guard(Session::get('guard'))->id() }}">
												<button type="submit" class="button is-link" name="submit">Update</button>
											</div>
											<!-- end control -->

										</div>
										<!-- end columns -->

				          </form>
									<!-- end form -->
								</div>
							</div>

						</div>

					</div>

				</div>
				<!-- end columns -->

			</div>
			<!-- end column -->

	  </div>
	  <!-- end columns -->

	</div>
	<!-- end container -->

</section>
<!-- end summary -->

@endsection
