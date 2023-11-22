@extends(Config::get('routing.application.modules.landing.dcs.layout').'.structure.index')

@section('main-content')

@php

  $calculate['booking'] = $data['venue']->venue_amount * Session::get('temporary.duration');;
  $calculate['racquet'] = 0;
  $calculate['shuttlecock'] = 0;

  if(Session::get('temporary.gear_needed') == 'yes'){

    if(Session::get('temporary.racquet')){
      $calculate['racquet'] = $data['equipment']['racquet']->amount;
    }

    if(Session::get('temporary.shuttlecock')){
      $calculate['shuttlecock'] = $data['equipment']['ball']->amount;
    }

  }

  $total = $calculate['booking'] + $calculate['racquet'] + $calculate['shuttlecock'];
@endphp

<!-- container -->
<div class="container pt-5 mt-5">

  <!-- columns -->
  <div class="columns">

    <!-- venue selected -->
    <div class="column is-12">
      <div class="widget">
        <h4 class="widget-title"><span>Receipt</span></h4>
        <table class="table is-bordered" style="width:100%;">
          <tbody>
            <tr>
              <th class="has-background-info has-text-light">Payment ID</th>
              <td style="width:80%">{{ Session::get('temporary.payment_id') }}</td>
            </tr>
            <tr>
              <th class="has-background-info has-text-light">Venue</th>
              <td style="width:80%">{{ $data['venue']->name }}</td>
            </tr>
            <tr>
              <th class="has-background-info has-text-light">Venue category</th>
              <td style="width:80%">{{ ucwords(strtolower($data['venue']->venue_category_name)) }}</td>
            </tr>
            <tr>
              <th class="has-background-info has-text-light">Time Booked</th>
              <td style="width:80%">{{ Carbon\Carbon::parse($data['operation']['hour']->time)->format('H:i A') }} - {{ Carbon\Carbon::parse($data['operation']['hour']->time)->addHours(Session::get('temporary.duration'))->minute(0)->format('H:i A') }}</td>
            </tr>
            <tr>
              <th class="has-background-info has-text-light">Duration</th>
              <td style="width:80%">{{ Session::get('temporary.duration') }} Hour</td>
            </tr>
            <tr>
              <td class="has-background-info has-text-light">Booked Date</td>
              <td style="width:80%">{{ Carbon\Carbon::parse(Session::get('temporary.date'))->format('d F Y') }}</td>
            </tr>
            <tr>
              <td class="has-background-info has-text-light">Status</td>
              <td style="width:80%">Paid</td>
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
              <td style="width:20%;text-align:right;">RM{{ number_format($calculate['booking'],2) }}</td>
            </tr>
            @if(Session::get('temporary.gear_needed') == 'yes')

              @if(Session::get('temporary.racquet'))
                <tr>
                  <th style="width:80%">{{ $data['equipment']['racquet']->name }} {{ $data['equipment']['racquet']->quantity }}Qty</th>
                  <td style="width:20%;text-align:right;">RM{{ number_format($calculate['racquet'],2) }}</td>
                </tr>
              @endif

              @if(Session::get('temporary.shuttlecock'))
                <tr>
                  <th style="width:80%">{{ $data['equipment']['ball']->name }} - {{ ucwords($data['equipment']['ball']->type) }} {{ $data['equipment']['ball']->quantity }}Qty</th>
                  <td style="width:20%;text-align:right;">RM{{ number_format($calculate['shuttlecock'],2) }}</td>
                </tr>
              @endif
              <!-- <tr>
                <th  class="has-background-info has-text-light" colspan="2">Add On</th>
              </tr> -->
            @endif

            <tr>
              <th class="has-background-info has-text-light" style="width:80%">Total Price</th>

              <td class="has-background-info has-text-light" style="width:20%;text-align:right;">
                <h4 class="has-text-light">RM{{ number_format($total,2) }}</h4>
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
  <div class="columns is-pulled-right">

    <div class="column is-12">
      <div class="field">
        <p class="control">
          <input type="hidden" name="total_amount" value="{{ $total }}">
          <a href="{{ route($hyperlink['navigation']['header']['home']) }}" class="button is-info">Back to Home</a>
        </p>
      </div>
    </div>

  </div>
  <!-- end control -->

</div>
<!-- end container -->

@endsection
