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
							<h3 class="has-text-left">View Employee</h3>

							<div class="notification is-link mt-5">
							  <strong>Password will be your birth date in reverse yyyymmdd</strong>
							</div>

							<div class="columns pt-5">

								<div class="column is-full pricing-item">
									<!-- form -->
									<form action="{{ route($hyperlink['page']['create']) }}" method="POST">
										{{ csrf_field() }}

										<!-- columns -->
										<div class="columns is-multiline">

											<!-- name -->
				              <div class="input-group py-0 column is-12" style="text-align:left">
				                <label for="name">Name</label>
				                <input type="text" class="input" placeholder="Enter Name" name="name" value="{{ old('name') }}">
				              </div>
				              <!-- end name -->

				              <!-- email -->
				              <div class="input-group py-0 column is-12" style="text-align:left">
				                <label for="email">Email</label>
				                <input type="text" class="input" placeholder="Enter Email" name="email" value="{{ old('email') }}">
				              </div>
				              <!-- end email -->

											<!-- role -->
				              <div class="input-group py-0 column is-6" style="text-align:left">
				                <label for="role">Role</label>
												<select class="input" name="role">
											  	<option value="">--Please Select--</option>
													<option value="admin" {{ ((old('role') == 'admin')?'selected':'') }}>Admin</option>
													<option value="superadmin" {{ ((old('role') == 'superadmin')?'selected':'') }}>Superadmin</option>
													<option value="staff" {{ ((old('role') == 'staff')?'selected':'') }}>Staff</option>
											  </select>
				              </div>
				              <!-- end role -->

											<!-- status -->
											<div class="input-group py-0 column is-6" style="text-align:left">
										    <label for="status">Status</label>
											  <select class="input" name="status">
											  	<option value="">--Please Select--</option>
													<option value="active" {{ ((old('status') == 'active')?'selected':'') }}>Active</option>
													<option value="inactive" {{ ((old('status') == 'inactive')?'selected':'') }}>Inactive</option>
													<option value="draft" {{ ((old('status') == 'draft')?'selected':'') }}>Draft</option>
											  </select>
											</div>
											<!-- end status -->

											<!-- control -->
											<div class="input-group py-0 column is-12 has-text-centered">
												<button type="submit" class="button is-link" name="submit">Register</button>
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

@include(Config::get('routing.application.modules.landing.dcs.layout').'.plugins.sweetalert.index')

@endsection
