@extends(Config::get('routing.application.modules.landing.dcs.layout').'.structure.index')

@section('main-content')

@php

  $calculate['booking'] = $data['venue']->venue_amount * Session::get('temporary.duration');
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
  <div class="notification is-link">
  <button class="delete"></button>
    <strong>Notes: All Booked are Not <u>REFUNDABLE</u></strong>
  </div>

  <form action="{{ route($hyperlink['page']['booking']['authorization']) }}" method="GET">
    {{ csrf_field() }}

    <!-- columns -->
    <div class="columns">

      <!-- venue selected -->
      <div class="column is-12">
        <div class="widget">
          <h4 class="widget-title"><span>Booking Confirmation</span></h4>
          <table class="table is-bordered" style="width:100%;">
            <tbody>
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

    <!-- columns -->
    <div class="columns">

      <!-- payment option -->
      <div class="column is-12">
        <div class="widget">
          <h4 class="widget-title"><span>Payment Type</span></h4>

          <!-- payment option -->
          <div class="columns">
            <div class="column is-12">
              <div class="field">
                <label class="label">Payment Option</label>
                <div class="select" style="width:100%;">
                  <select id="payment_option" name="payment_option" style="width:100%;">
                    <option value="">Please Select</option>
                    @foreach($data['payment']['type'] as $key=>$value)
                      <option value="{{ $value->payment_type_id }}">{{ $value->name }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
            </div>
          </div>
          <!-- end payment option -->

          <!-- group online banking -->
          <div id="group-online-banking" style="display:none">

            <div class="columns">
              <div class="column is-12">
                <div class="field">
                  <label class="label">Select Bank</label>
                  <div class="select" style="width:100%;">
                    <select id="payment_online_banking_id" name="payment_online_banking_id" style="width:100%;">
                      <option value="">Please Select</option>
                      @foreach($data['payment']['online']['banking'] as $key=>$value)
                        <option value="{{ $value->payment_online_banking_id }}">{{ $value->name }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
              </div>
            </div>

          </div>
          <!-- end group online banking -->

          <!-- group credit card -->
          <div id="group-credit-card" style="display:none">

            <!-- payment network -->
            <div class="columns">
              <div class="column is-12">
                <div class="field">
                  <label class="label">Payment Network</label>
                  <div class="select" style="width:100%;">
                    <select id="payment_network_id" name="payment_network_id" style="width:100%;">
                      <option value="">Please Select</option>
                      @foreach($data['payment']['network'] as $key=>$value)
                        <option value="{{ $value->payment_network_id }}">{{ $value->name }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
              </div>
            </div>
            <!-- end payment network -->

            <!-- card number -->
            <div class="columns">
              <div class="column is-12">
                <div class="field">
                  <label class="label">Card Number</label>
                  <div class="control has-icons-left has-icons-right">
                    <input type="text" class="input" name="card_no" onkeypress="validateCardNumber(event)" placeholder="Enter your credit card number" maxlength="16">
                    <span class="icon is-small is-left">
                      <i class="ti-credit-card"></i>
                    </span>
                  </div>
                </div>
              </div>
            </div>
            <!-- end card number -->

            <!-- card name -->
            <div class="columns">
              <div class="column is-12">
                <div class="field">
                  <label class="label">Card Name</label>
                  <div class="control has-icons-left has-icons-right">
                    <input type="text" class="input" name="card_name" placeholder="Card Name">
                    <span class="icon is-small is-left">
                      <i class="ti-user"></i>
                    </span>
                  </div>
                </div>
              </div>
            </div>
            <!-- end card name -->

            <!-- card name -->
            <div class="columns">
              <div class="column is-6">
                <div class="field">
                  <label class="label">CCV</label>
                  <div class="control has-icons-left has-icons-right">
                    <input class="input" type="text" name="ccv" onkeypress="validateCCV(event)" placeholder="Card Name" maxlength="3">
                    <span class="icon is-small is-left">
                      <i class="ti-credit-card"></i>
                    </span>
                  </div>
                </div>
              </div>

              <div class="column is-6">
                <div class="field">
                  <label class="label">Date Expired</label>
                  <div class="control has-icons-left has-icons-right">
                    <input class="input" type="month" name="date_expired" placeholder="Date Expired" min="{{ \Carbon\Carbon::now()->addYear()->format('Y-m') }}">
                    <span class="icon is-small is-left">
                      <i class="ti-calendar"></i>
                    </span>
                  </div>
                </div>
              </div>
            </div>
            <!-- end card name -->

          </div>
          <!-- end group credit card -->

        </div>
      </div>
      <!-- end payment option -->

    </div>
    <!-- end columns -->

    <!-- control -->
    <div class="columns is-pulled-right">

      <div class="column is-12">
        <div class="field">
          <p class="control">
            <input type="hidden" name="total_amount" value="{{ $total }}">
            <input type="submit" class="button is-info" name="submit" value="Make Payment">
          </p>
        </div>
      </div>

    </div>
    <!-- end control -->

  </form>

</div>
<!-- end container -->

<script type="text/javascript">

  $(document).ready(function(){

    //Online Banking Disabled
    $('#payment_online_banking_id').prop('disabled',true);

    //Credit Card Disabled

    $('#payment_option').on('change',function(){

      switch($(this).val()){

        //Online Banking
        case 'ob':
          $('#group-online-banking').slideDown();
          $('#group-credit-card').slideUp();

          //Online Banking Enabled
          $('#payment_online_banking_id').prop('disabled',false);

          //Credit Card Disabled
          $('#shuttlecock').prop('disabled',false);
        break;

        //Credit Card
        case 'cc':
          $('#group-online-banking').slideUp();
          $('#group-credit-card').slideDown();
          $('#racquet').prop('disabled',false);
          $('#shuttlecock').prop('disabled',false);
        break;

        default:
          $('#group-online-banking').slideUp();
        break;

      }
    });

  });

  function validateCCV(evt) {
    var theEvent = evt || window.event;

    // Handle paste
    if (theEvent.type === 'paste') {
        key = event.clipboardData.getData('text/plain');
    } else {
    // Handle key press
        var key = theEvent.keyCode || theEvent.which;
        key = String.fromCharCode(key);
    }
    var regex = /[0-9]|\./;
    if( !regex.test(key) ) {
      theEvent.returnValue = false;
      if(theEvent.preventDefault) theEvent.preventDefault();
    }
  }

  function validateCardNumber(evt) {
    var theEvent = evt || window.event;

    // Handle paste
    if (theEvent.type === 'paste') {
        key = event.clipboardData.getData('text/plain');
    } else {
    // Handle key press
        var key = theEvent.keyCode || theEvent.which;
        key = String.fromCharCode(key);
    }
      var regex = /[0-9]|\./;
    if( !regex.test(key) ) {
      theEvent.returnValue = false;
      if(theEvent.preventDefault) theEvent.preventDefault();
    }
}

</script>

@endsection
