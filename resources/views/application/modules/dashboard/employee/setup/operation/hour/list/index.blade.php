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

						<div class="widget widget-about">

							<div class="columns">
								<div class="column is-half">
									<h3 class="has-text-left">Manage Operation Hour</h3>
								</div>
								<div class="column is-half" style="text-align:right">
									<!-- add new -->
									<a href="{{ route($hyperlink['page']['new']) }}" class="button is-small my-2">Add New</a>
									<!-- end add new -->
								</div>
							</div>


							<div class="columns pt-5 mt-5">

								<div class="column is-full pricing-item">

									<!-- table responsive -->
				          <div class="table-responsive">

				            <!-- table -->
										<table id="table-data" class="table" style="width:100%">

											<!-- thead -->
							        <thead>
						            <tr>
					                <th>No.</th>
					                <th class="col-md-12">Day</th>
													<th class="col-md-12">Time</th>
					                <th>Status</th>
					                <th class="has-text-centered">Action</th>
						            </tr>
							        </thead>
											<!-- end thead -->

											<!-- tbody -->
											<tbody>
												@if($data['main'])

													@foreach($data['main'] as $key=>$value)

													<tr>
														<td>{{ ($key+1) }}</td>
														<td>{{ $value->day_id }}</td>
														<td>{{ $value->time }}</td>
														<td>
															<h5>
															<span class="tag
																@switch($value->status)
																	@case('active')
																		tag is-success
																	@break
																	@case('inactive')
																		tag is-warning
																	@break
																	@case('draft')
																		tag is-info
																	@break
																@endswitch
															">{{ ucwords($value->status) }}</span>
															</h5>
														</td>
														<td class="has-text-centered">
															<a href="{{ route($hyperlink['page']['view'],['id'=>$value->operation_hour_id.'_'.$value->day_id]) }}"><i class="ti-ruler-pencil has-text-black"></i></a>
															<span class="btn-delete" data-href="{{ route($hyperlink['page']['delete'],['id'=>$value->operation_hour_id.'_'.$value->day_id]) }}" data-swal-template="#my-template"><i class="ti-trash"></i></span>
														</td>
													</tr>

													@endforeach

												@endif

											</tbody>
											<!-- end tbody -->

			    					</table>
				            <!-- end table -->

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

@include(Config::get('routing.application.modules.landing.dcs.layout').'.plugins.datatable.index')
@include(Config::get('routing.application.modules.landing.dcs.layout').'.plugins.sweetalert.index')


<script type="text/javascript">

	$(document).ready(function(){

		$('#table-data').DataTable({
			info: false,
			lengthChange: false,
			drawCallback: function () {
			// Initialize SweetAlert here
			$('[class*="btn-delete"]').on('click',function(){
				console.log($(this).attr('data-href'));
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
			},
		});

	});

</script>
@endsection
