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
							<h3 class="has-text-left">View Announcement</h3>

							<div class="columns pt-5 mt-5">

								<div class="column is-full pricing-item">
									<div class="card-content">

										<!-- columns -->
										<div class="columns is-multiline">

											<!-- title -->
											<div class="input-group py-0 column is-12">
												<h3>{{ $data['main']->title }}</h3>
				              </div>
											<!-- end title -->

											<!-- description -->
											<div class="input-group py-0 column is-12">
										    <label for="description">Description</label>
											  <textarea class="input" name="description" rows="8" cols="80">{!! $data['main']->description !!}</textarea>
											</div>
											<!-- end description -->

											<!-- control -->
											<div class="input-group py-0 column is-12 has-text-centered">
												<a href="{{ route($hyperlink['navigation']['authorization']['customer']['home']) }}" class="button is-warning">Back</a>
											</div>
											<!-- end control -->

										</div>
										<!-- end columns -->

					        </div>
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
