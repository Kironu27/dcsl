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
							<h3 class="has-text-left">Add Operation Hour</h3>

							<div class="columns pt-5 mt-5">

								<div class="column is-full pricing-item">
									<!-- form -->
				          <form action="{{ route($hyperlink['page']['create']) }}" method="POST">
										{{ csrf_field() }}

										<!-- columns -->
										<div class="columns is-multiline">

											<!-- name -->
											<div class="input-group py-0 column is-6">
												<label for="operation_hour_id">Operation Hour ID</label>
												<input type="text" class="input" placeholder="Enter Code" name="operation_hour_id" onkeypress="validateOperationHour(event)" value="{{ old('operation_hour_id') }}" maxlength="4">
											</div>
											<!-- end name -->

											<!-- name -->
											<div class="input-group py-0 column is-6">
												<label for="name">Day ID</label>
												<select class="input" name="day_id">
													<option value="">Please Select</option>
													<option value="sunday" {{ ((old('day_id') == 'sunday')?'selected':'') }}>Sunday</option>
													<option value="monday" {{ ((old('day_id') == 'monday')?'selected':'') }}>Monday</option>
													<option value="tuesday" {{ ((old('day_id') == 'tuesday')?'selected':'') }}>Tuesday</option>
													<option value="wednesday" {{ ((old('day_id') == 'wednesday')?'selected':'') }}>Wednesday</option>
													<option value="thursday" {{ ((old('day_id') == 'thursday')?'selected':'') }}>Thursday</option>
													<option value="friday" {{ ((old('day_id') == 'friday')?'selected':'') }}>Friday</option>
													<option value="saturday" {{ ((old('day_id') == 'saturday')?'selected':'') }}>Saturday</option>
												</select>
											</div>
											<!-- end name -->

											<!-- time -->
											<div class="input-group py-0 column is-6">
												<label for="time">Time</label>
												<input type="time" class="input" placeholder="Enter Time" name="time" value="{{ old('time') }}">
											</div>
											<!-- end time -->

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

<script type="text/javascript">

function validateOperationHour(evt) {
	var theEvent = evt || window.event;

	// Handle paste
	if (theEvent.type === 'paste') {
			key = event.clipboardData.getData('text/plain');
	} else {
	// Handle key press
			var key = theEvent.keyCode || theEvent.which;
			key = String.fromCharCode(key);
	}
	var regex = /[0-9]|\./;
	if( !regex.test(key) ) {
		theEvent.returnValue = false;
		if(theEvent.preventDefault) theEvent.preventDefault();
	}
}

</script>
@endsection
