@extends(Config::get('routing.application.modules.dashboard.employee.layout').'.structure.index')

@section('main-content')

<!-- summary -->
<section class="features-area py-5">

	<!-- container -->
	<div class="container py-5">

	  <!-- columns -->
	  <div class="columns is-multiline is-desktop is-justify-content-center">

			{{-- Panel Sidebar --}}
			@include(Config::get('routing.application.modules.dashboard.employee.layout').'.navigation.panel.index')

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
							<h3 class="has-text-left">Change Password</h3>

							<div class="columns pt-5 mt-5">

								<div class="column is-full pricing-item">
									<!-- form -->
									<form action="{{ route($hyperlink['page']['update']) }}" method="POST">
									{{ csrf_field() }}

										<!-- columns -->
										<div class="columns is-multiline">

											<!-- password current -->
											<div class="input-group py-0 column is-12">
												<label for="password_current">Current Password</label>
												<input type="password" class="input" placeholder="Current Password" name="password_current" value="">
											</div>
											<!-- end password current -->

											<!-- password new -->
											<div class="input-group py-0 column is-12">
												<label for="password_new">New Password</label>
												<small>( 1 Uppercase, 1 Lowercase, 1 Numeric, 1 Symbol and Range Length is 6 )</small>
												<input type="password" class="input" placeholder="New Password" name="password_new" value="">
											</div>
											<!-- end password new -->

											<!-- password confirmation -->
											<div class="input-group py-0 column is-12">
												<label for="password_confirmation">Confirmation Password</label>
												<input type="password" class="input" placeholder="Confirmation Password" name="password_confirmation" value="">
											</div>
											<!-- end password confirmation -->

											<!-- control -->
											<div class="input-group py-0 column is-12 has-text-centered">
												<input type="hidden" name="id" value="{{ Auth::guard(Session::get('guard'))->id() }}">
												<button type="submit" class="button is-link" name="submit">Update Password</button>
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
