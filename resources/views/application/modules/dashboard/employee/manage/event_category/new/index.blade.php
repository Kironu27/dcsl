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

						<!-- card title -->
					 	<h4 class="card-title">Add Event Category</h4>
					 	<!-- end card title -->

					</div>
					<!-- end card header -->

	        <!-- card body -->
	        <div class="card-body">

						@if(Session::get('message'))
					    <div class="alert alert-{{ ((Session::get('alert_type') == 'success')?'success':'danger') }}">
				        {{ Session::get('message') }}
					    </div>
						@endif

						@if($errors->any())
					    <div class="alert alert-danger">
				        <ul>
			            @foreach ($errors->all() as $error)
		                <li>{{ $error }}</li>
			            @endforeach
				        </ul>
					    </div>
						@endif

						<!-- form -->
	          <form action="{{ route($hyperlink['page']['create']) }}" method="POST">
							{{ csrf_field() }}

							<!-- row -->
							<div class="row">

								<!-- name -->
								<div class="col-md-6">
									<div class="form-group">
								    <label for="name">Name</label>
								    <input type="text" class="form-control" placeholder="Name" name="name" value="{{ old('name') }}">
								  </div>
								</div>
								<!-- end name -->

								<!-- status -->
								<div class="col-md-6">
									<div class="form-group">
								    <label for="status">Status</label>
									  <select class="form-control" name="status">
									  	<option value="">--Please Select--</option>
											<option value="active" {{ ((old('status') == 'active')?'selected':'') }}>Active</option>
											<option value="inactive" {{ ((old('status') == 'inactive')?'selected':'') }}>Inactive</option>
									  </select>
								  </div>
								</div>
								<!-- end status -->

							</div>
							<!-- end row -->

							<!-- row -->
							<div class="row">

								<!-- control -->
								<div class="col-md-12 text-center">
									<a href="{{ route($hyperlink['page']['list']) }}" class="btn btn-warning">Back</a>
									<button type="submit" class="btn btn-primary" name="submit">Create</button>
								</div>
								<!-- end control -->

							</div>
							<!-- end row -->

	          </form>
						<!-- end form -->

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

@endsection
