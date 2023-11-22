@extends(Config::get('routing.application.modules.dashboard.customer.layout').'.structure.index')

@section('main-content')

  <!-- container -->
  <div class="container py-5">

    <!-- columns -->
    <div class="columns">

      <!-- column -->
      <div class="column is-12">

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
      <!-- end col -->

    </div>
    <!-- end columns -->

  </div>
  <!-- end container -->

  @include(Config::get('routing.application.modules.landing.dcs.layout').'.plugins.datatable.index')
  @include(Config::get('routing.application.modules.landing.dcs.layout').'.plugins.sweetalert.index')

  <script type="text/javascript">

    $(document).ready(function(){

      $('#table-data').DataTable({
        info: false,
        lengthChange: false,

      });

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
