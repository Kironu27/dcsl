@extends(Config::get('routing.application.modules.dashboard.administrator.layout').'.structure.index')

@section('main-content')

	<!-- container -->
	<div class="container py-5">

	  <!-- row -->
	  <div class="row">

	    <!-- col -->
	    <div class="col-md-12 grid-margin stretch-card">

	      <!-- card -->
	      <div class="card">

					<!-- card header -->
					<div class="card-header">

						<div class="row d-flex justify-content-between align-items-center px-3">

						<!-- card title -->
					 	<h4 class="card-title">Manage Event Category</h4>
					 	<!-- end card title -->

						<!-- dropdown -->
						<a href="#" class="btn pull-right dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="icon-settings"></i></a>
		          <div class="dropdown-menu dropdown-menu-right">
		            <a href="{{ route($hyperlink['page']['new']) }}" class="dropdown-item">Add New</a>
		          </div>
						</div>
						<!-- end dropdown -->

					</div>
					<!-- end card header -->

	        <!-- card body -->
	        <div class="card-body">

						@if(Session::get('message'))
					    <div class="alert alert-{{ ((Session::get('alert_type') == 'success')?'success':'danger') }}">
				        {{ Session::get('message') }}
					    </div>
						@endif

	          <!-- table responsive -->
	          <div class="table-responsive">

	            <!-- table -->
							<table id="table-data" class="table" style="width:100%">

								<!-- thead -->
				        <thead>
			            <tr>
		                <th>No.</th>
		                <th class="col-md-6">Name</th>
		                <th>Status</th>
		                <th>Action</th>
			            </tr>
				        </thead>
								<!-- end thead -->

								<!-- tbody -->
								<tbody>

									@if($data['main'])

										@foreach($data['main'] as $key=>$value)

					            <tr>
				                <td>{{ ($key+1) }}</td>
				                <td>{{ $value->name }}</td>
				                <td>
													<h5>
													<span class="p-2 badge
														@switch($value->status)
															@case('active')
																badge-success
															@break
															@case('inactive')
																badge-warning text-white
															@break
														@endswitch
													">{{ ucwords($value->status) }}</span>
													</h5>
												</td>
				                <td>
													<div class="dropdown">
													  <button type="button" class="btn btn-sm btn-warning text-white dropdown-toggle" data-toggle="dropdown">
													    Manage
													  </button>
													  <div class="dropdown-menu">
													    <a class="dropdown-item" href="{{ route($hyperlink['page']['view'],['id'=>$value->event_category_id]) }}">View</a>
													    <span class="dropdown-item btn-delete" data-href="{{ route($hyperlink['page']['delete'],['id'=>$value->event_category_id]) }}" data-swal-template="#my-template">Delete</span>
													  </div>
													</div>
												</td>
					            </tr>

										@endforeach

									@endif

								</tbody>
								<!-- end tbody -->

    					</table>
	            <!-- end table -->

	          </div>
	          <!-- end table responsive -->

	        </div>
	        <!-- end card body -->

	      </div>
	      <!-- end card -->

	    </div>
	    <!-- end col -->

	  </div>
	  <!-- end row -->

	</div>
	<!-- end container -->

	@include(Config::get('routing.application.modules.landing.youthnited.layout').'.plugins.datatable.index')
	<script type="text/javascript">

		$(document).ready(function(){

	    $('#table-data').DataTable(
				{
					'info':false,
					'lengthChange':false,
					'dom': "<'row'<'col-lg-12 col-md-12 col-xs-12'f><'col-lg-2 col-md-2 col-xs-12'l>>" +
	           "<'row'<'col-sm-12'tr>>" +
	           "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
				}
			);

			$('[class*="btn-delete"]').on('click',function(){

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
