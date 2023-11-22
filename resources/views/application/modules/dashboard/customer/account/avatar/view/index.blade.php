@extends(Config::get('routing.application.modules.dashboard.customer.layout').'.structure.index')

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
							<h3 class="has-text-left">My Avatar</h3>

							<div class="columns pt-5 mt-5">

								<div class="column is-full pricing-item">
									<!-- form -->
				          <form action="{{ route($hyperlink['page']['update']) }}" method="POST" enctype="multipart/form-data">
									{{ csrf_field() }}
										<small>Image Must be PNG</small>
										<!-- columns -->
										<div class="columns is-multiline">

											<div class="avatar-wrapper">
											  @if(\Storage::disk()->exists('public\\users\\'.Session::get('guard').'\\'.Auth::guard(Session::get('guard'))->id().'\\avatar\\image.png'))
											    <img class="profile-pic" src="{{ asset('storage\\users\\'.Session::get('guard').'\\'.Auth::guard(Session::get('guard'))->id().'\\avatar\\image.png') }}"/>
											  @else
											    <img class="profile-pic" src="{{ asset('images\\avatar\\user.png') }}"/>
											  @endif
											  <div class="upload-button">
											    <i class="ti ti-cloud-up fa-arrow-circle-up" aria-hidden="true"></i>
											  </div>
											  <input class="file-upload" type="file" name="avatar" accept="image/png"/>
											</div>

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
