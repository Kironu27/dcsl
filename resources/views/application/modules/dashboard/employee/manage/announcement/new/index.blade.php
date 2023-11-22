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
							<h3 class="has-text-left">Add Announcement</h3>

							<div class="columns pt-5 mt-5">

								<div class="column is-full pricing-item">
									<!-- form -->
									<form action="{{ route($hyperlink['page']['create']) }}" method="POST">
										{{ csrf_field() }}

										<!-- columns -->
										<div class="columns is-multiline">

											<!-- title -->
											<div class="input-group py-0 column is-12">
												<label for="title">Title</label>
												<input type="text" class="input" placeholder="Enter Title" name="title" value="{{ old('title') }}">
			                </div>
											<!-- end title -->

											<!-- target -->
											<div class="input-group py-0 column is-6">
										    <label for="target">Target</label>
											  <select class="input" name="target">
											  	<option value="">--Please Select--</option>
													<option value="all" {{ ((old('status') == 'all')?'selected':'') }}>All</option>
													<option value="customer" {{ ((old('status') == 'customer')?'selected':'') }}>Customer</option>
											  </select>
											</div>
											<!-- end target -->

											<!-- status -->
											<div class="input-group py-0 column is-6">
										    <label for="status">Status</label>
											  <select class="input" name="status">
											  	<option value="">--Please Select--</option>
													<option value="active" {{ ((old('status') == 'active')?'selected':'') }}>Active</option>
													<option value="inactive" {{ ((old('status') == 'inactive')?'selected':'') }}>Inactive</option>
													<option value="draft" {{ ((old('status') == 'draft')?'selected':'') }}>Draft</option>
											  </select>
											</div>
											<!-- end status -->

											<!-- description -->
											<div class="input-group py-0 column is-12">
										    <label for="description">Description</label>
											  <textarea class="input" name="description" rows="8" cols="80">{!! old('description') !!}</textarea>
											</div>
											<!-- end description -->

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

	$(document).ready(function() {

		var readURL = function(input) {
				if (input.files && input.files[0]) {
						var reader = new FileReader();

						reader.onload = function (e) {
								$('.profile-pic').attr('src', e.target.result);
						}

						reader.readAsDataURL(input.files[0]);
				}
		}

		$(".file-upload").on('change', function(){
				readURL(this);
		});

		$(".upload-button").on('click', function() {
			 $(".file-upload").click();
		});

	});

	</script>
@endsection
