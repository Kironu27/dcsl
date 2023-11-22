@extends(Config::get('routing.application.modules.dashboard.employee.layout').'.structure.index')

@section('main-content')

<!-- summary -->
<section class="features-area py-5">

  <!-- container -->
	<div class="container">

		<!-- columns -->
		<div class="columns is-multiline is-desktop is-justify-content-center">

			{{-- Panel Sidebar --}}
			@include(Config::get('routing.application.modules.dashboard.customer.layout').'.navigation.panel.index')

			<!-- columns -->
      <div class="column is-8-desktop mb-5 sidebar-home">

        <!-- card -->
        <div class="card">

          <!-- card header -->
          <div class="card-header">

            <!-- row -->
            <div class="row d-flex justify-content-between align-items-center px-3">

            <!-- card title -->
            <h4 class="card-header-title">Announcement</h4>
            <!-- end card title -->

            </div>
            <!-- end row -->

          </div>
          <!-- end card header -->

          <!-- card content -->
          <div class="card-content">

            <!-- table responsive -->
            <div class="table-responsive">

              <!-- table -->
              <table id="table-data" class="table" style="width:100%">

                <!-- thead -->
                <thead>
                  <tr>
                    <th>No.</th>
                    <th>Title</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <!-- end thead -->

                <!-- tbody -->
                <tbody>

                  @if($data['announcement'])

                    @foreach($data['announcement'] as $key=>$value)

                      <tr>
                        <td>{{ ($key+1) }}</td>
                        <td>{{ $value->title }}</td>
                        <td class="has-text-centered">
													<a href="{{ route($hyperlink['page']['announcement']['view'],['id'=>$value->announcement_id]) }}"><i class="ti-eye has-text-black"></i></a>
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
          <!-- end card content -->

        </div>
        <!-- end card -->

			</div>
			<!-- columns -->

    </div>
		<!-- end columns -->

	</div>
  <!-- end container -->

</section>
<!-- end summary -->

@endsection
