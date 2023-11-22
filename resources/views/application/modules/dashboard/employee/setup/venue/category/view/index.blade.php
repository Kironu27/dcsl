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
							<h3 class="has-text-left">View Venue Category</h3>

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
									<input type="text" class="input" placeholder="Enter name" name="name" value="{{ $data['main']->name }}">
								</div>
								<!-- end name -->

								<!-- status -->
								<div class="input-group py-0 column is-6">
								<label for="status">Status</label>
									<select class="input" name="status">
									<option value="">--Please Select--</option>
										<option value="active" {{ (($data['main']->status == 'active')?'selected':'') }}>Active</option>
										<option value="inactive" {{ (($data['main']->status == 'inactive')?'selected':'') }}>Inactive</option>
									</select>
								</div>
								<!-- end status -->

								<!-- control -->
								<div class="input-group py-0 column is-12 has-text-centered">
									<input type="hidden" name="id" value="{{ $data['main']->venue_category_id }}">
									<a href="{{ route($hyperlink['page']['list']) }}" class="button is-warning">Back</a>
									<button type="button" id="btn-delete" data-href="{{ route($hyperlink['page']['delete'],['id'=>$data['main']->venue_category_id]) }}" class="button is-danger" data-swal-template="#my-template">Delete</button>
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

	@include(Config::get('routing.application.modules.landing.dcs.layout').'.plugins.sweetalert.index')

	<script type="text/javascript">

		$(document).ready(function(){

			$('#btn-delete').on('click',function(){

				//Get Url
				var url = $(this).attr('data-href');

				Swal.fire({
				  title: 'Do you want to Delete ?',
				  showDenyButton: true,
				  confirmButtonText: 'Yes',
				  denyButtonText: `No`,
				}).then((result) => {
				  /* Read more about isConfirmed, isDenied below */
				  if (result.isConfirmed) {
						window.location.href = url;
				    //Swal.fire('Saved!', '', 'success')
				  } else if (result.isDenied) {
				    Swal.fire('Changes are not saved', '', 'info')
				  }
				})

			});

		});

	</script>

@endsection
