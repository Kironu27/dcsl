@extends(Config::get('routing.application.modules.dashboard.customer.layout').'.structure.index')

@section('main-content')

<!-- container -->
<div class="container pt-5 mt-5">

  <!-- columns -->
  <div class="columns">

    <!-- venue selected -->
    <div class="column is-12">
      <div class="widget">
        <h4 class="widget-title"><span>Booking Information</span></h4>
        <table class="table is-bordered" style="width:100%;">
          <tbody>
            <tr>
              <th class="has-background-info has-text-light">Payment ID</th>
              <td style="width:80%">{{ $data['main']->payment_id }}</td>
            </tr>
            <tr>
              <th class="has-background-info has-text-light">Venue</th>
              <td style="width:80%">{{ $data['main']->venue_name }}</td>
            </tr>
            <tr>
              <th class="has-background-info has-text-light">Venue category</th>
              <td style="width:80%">{{ ucwords($data['main']->venue_category_id) }}</td>
            </tr>
            <tr>
              <th class="has-background-info has-text-light">Time Booked</th>
              <td style="width:80%">{{ Carbon\Carbon::parse($data['main']->booking_time)->format('H:i A') }} - {{ Carbon\Carbon::parse($data['main']->booking_time)->addHours($data['main']->booking_duration)->minute(0)->format('H:i A') }}</td>
            </tr>
            <tr>
              <th class="has-background-info has-text-light">Duration</th>
              <td style="width:80%">{{ $data['main']->booking_duration }} Hour</td>
            </tr>
            <tr>
              <td class="has-background-info has-text-light">Booked Date</td>
              <td style="width:80%">{{ Carbon\Carbon::parse($data['main']->booking_time)->format('H:i A') }}</td>
            </tr>
            <tr>
              <td class="has-background-info has-text-light">Status</td>
              <td style="width:80%">{{ ucwords($data['main']->status) }}</td>
            </tr>
          </tbody>
        </table>

				<table class="table is-bordered" style="width:100%;">
          <thead>
            <tr>
              <th class="has-background-info has-text-light">Name</th>
              <th class="has-background-info has-text-light" style="text-align:right">Price</th>
            </tr>
          <thead>
          <tbody>
            <tr>
              <th style="width:80%">Booking Fee</th>
              <td style="width:20%;text-align:right;">RM{{ number_format($data['main']->venue_amount * $data['main']->booking_duration,2) }}</td>
            </tr>
            @if($data['main']->gear_needed == 1)

              @if($data['main']->racquet)
                <tr>
                  <th style="width:80%">{{ $data['main']->equipment_racquet_name }} {{ $data['main']->equipment_racquet_quantity }}Qty</th>
                  <td style="width:20%;text-align:right;">RM{{ number_format($data['main']->equipment_racquet_amount,2) }}</td>
                </tr>
              @endif

              @if($data['main']->shuttlecock)
                <tr>
                  <th style="width:80%">{{ $data['main']->equipment_ball_name }} - {{ ucwords($data['main']->equipment_ball_type) }} {{ $data['main']->equipment_ball_quantity }}Qty</th>
                  <td style="width:20%;text-align:right;">RM{{ number_format($data['main']->equipment_ball_amount,2) }}</td>
                </tr>
              @endif
              <!-- <tr>
                <th  class="has-background-info has-text-light" colspan="2">Add On</th>
              </tr> -->
            @endif

            <tr>
              <th class="has-background-info has-text-light" style="width:80%">Total Price</th>

              <td class="has-background-info has-text-light" style="width:20%;text-align:right;">
                <h4 class="has-text-light">RM{{ number_format($data['main']->payment_price,2) }}</h4>
              </td>
            </tr>

          </tbody>
        </table>


      </div>
    </div>
    <!-- end venue selected -->

  </div>
  <!-- end columns -->

  <!-- control -->
  <div class="columns is-pulled-left">

    <div class="column is-12">
      <div class="field">
        <p class="control">
					<a href="{{ route($hyperlink['page']['list']) }}" class="button is-info">Back</a>
        </p>
      </div>
    </div>

  </div>
  <!-- end control -->

</div>
<!-- end container -->

@endsection
