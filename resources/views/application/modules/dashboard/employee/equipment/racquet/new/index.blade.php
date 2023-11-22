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
							<h3 class="has-text-left">Add Equipment Racquet</h3>

							<div class="columns pt-5 mt-5">

								<div class="column is-full pricing-item">
									<!-- form -->
				          <form action="{{ route($hyperlink['page']['create']) }}" method="POST">
										{{ csrf_field() }}

										<!-- columns -->
										<div class="columns is-multiline">

											<!-- sport id -->
											<div class="input-group py-0 column is-6">
												<label for="sport_id">Sport ID</label>
												<select class="input" name="sport_id">
													<option value="">Please Select</option>
													@foreach($data['sport'] as $key=>$value)
														<option value="{{ $value->sport_id }}" {{ ((old('sport_id') == $value->sport_id)?'selected':'') }}>{{ $value->name }}</option>
													@endforeach
												</select>

											</div>
											<!-- end sport id -->

											<!-- name -->
											<div class="input-group py-0 column is-6">
												<label for="name">Name</label>
												<input type="text" class="input" placeholder="Enter Name" name="name" value="{{ old('name') }}">
											</div>
											<!-- end name -->

											<!-- quantity -->
											<div class="input-group py-0 column is-6">
												<label for="quantity">Quantity</label>
												<input type="number" class="input" placeholder="Enter Quantity" name="quantity" value="{{ old('quantity') }}">
											</div>
											<!-- end quantity -->

											<!-- price -->
											<div class="input-group py-0 column is-6">
												<label for="amount">Price (RM)</label>
												<input type="text" class="input" placeholder="Enter Price" name="amount" value="{{ old('amount') }}">
											</div>
											<!-- end price -->

											<!-- status -->
											<div class="input-group py-0 column is-6">
											<label for="status">Status</label>
												<select class="input" name="status">
												<option value="">--Please Select--</option>
													<option value="active" {{ ((old('status') == 'active')?'selected':'') }}>Active</option>
													<option value="inactive" {{ ((old('status') == 'inactive')?'selected':'') }}>Inactive</option>
												</select>
											</div>
											<!-- end status -->

											<!-- control -->
											<div class="input-group py-0 column is-12 has-text-centered">
												<a href="{{ route($hyperlink['page']['list']) }}" class="button is-warning">Back</a>
												<button type="submit" class="button is-link" name="submit">Create</button>
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
