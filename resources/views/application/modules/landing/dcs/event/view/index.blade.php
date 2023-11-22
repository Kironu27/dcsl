@extends(Config::get('routing.application.modules.landing.dcs.layout').'.structure.index')

@section('main-content')

<!-- container -->
<div class="container pt-5 mt-5">

  @if(Session::get('message'))
    <div class="notification {{ ((Session::get('alert_type') == 'success')?'has-text-primary':'has-text-danger') }}">
      {{ Session::get('message') }}
    </div>
  @endif

  @if($errors->any())
    <div class="notification has-text-danger">
      <ul>
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <form action="{{ route($hyperlink['page']['booking']['authorization']) }}" method="GET">
    {{ csrf_field() }}

    <!-- columns -->
    <div class="columns">

      <!-- venue selected -->
      <div class="column is-12">
        <div class="widget">
          <h4 class="widget-title"><span>Venue Selected</span></h4>
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
                <td style="width:80%">{{ Carbon\Carbon::parse($data['operation']['hour']->time)->format('H:i A') }} - {{ Carbon\Carbon::parse($data['operation']['hour']->time)->addHours(request()->duration)->minute(0)->format('H:i A') }}</td>
              </tr>
              <tr>
                <th class="has-background-info has-text-light">Duration</th>
                <td style="width:80%">{{ request()->duration }} Hour</td>
              </tr>
              <tr>
                <td class="has-background-info has-text-light">Booked Date</td>
                <td style="width:80%">{{ Carbon\Carbon::parse(request()->date)->format('d F Y') }}</td>
              </tr>
              <tr>
                <td class="has-background-info has-text-light">Price (Per Hour)</td>
                <td style="width:80%">RM{{ number_format($data['venue']->venue_amount,2) }}</td>
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

      <!-- add on -->
      <div class="column is-12">

        <!-- widget -->
        <div class="widget">

          <!-- widget title -->
          <h4 class="widget-title"><span>Add-On</span></h4>
          <!-- end widget title -->

          <div class="columns">

            <div class="column is-12">
              <div class="field">
                <label class="label">Any Gear Needed?</label>
                <div class="select">
                  <select id="gear_needed" name="gear_needed">
                    <option value="">Please Select</option>
                    <option value="yes" {{ ((old('gear_needed') == 'yes')?'selected':'') }}>Yes</option>
                    <option value="no" {{ ((old('gear_needed') == 'no')?'selected':'') }}>No</option>
                  </select>
                </div>
              </div>
            </div>

          </div>

          <!-- add on group -->
          <div id="add-on-group" class="columns" style="display:none">

            <div class="column is-6">
              <div class="field">
                <label class="label">Racquet</label>
                <div class="select">
                  <select id="racquet" name="racquet">
                    <option value="">Please Select</option>
                    @foreach($data['equipment']['racquet'] as $key=>$value)
                      <option value="{{ $value->equipment_racquet_id }}" {{ ((old('racquet') == $value->equipment_racquet_id)?'selected':'') }}>{{ $value->quantity }}QTY - RM[{{ $value->amount }} ] </option>
                    @endforeach
                  </select>
                </div>
              </div>
            </div>

            <div class="column is-6">
              <div class="field">
                <label class="label">Shuttlecock</label>
                <div class="select">
                  <select id="shuttlecock" name="shuttlecock">
                    <option value="">Please Select</option>
                    @foreach($data['equipment']['ball'] as $key=>$value)
                      <option value="{{ $value->equipment_ball_id }}" {{ ((old('shuttlecock') == $value->equipment_ball_id)?'selected':'') }}>{{ ucwords($value->type) }} {{ $value->quantity }}QTY - RM[{{ $value->amount }} ] </option>
                    @endforeach
                  </select>
                </div>
              </div>
            </div>
          </div>
          <!-- end add on group -->

          <!-- control -->
          <div class="columns is-pulled-right">

            <div class="column is-12">
              <div class="field">
                <p class="control">
                  <input type="hidden" name="operation_hour_id" value="{{ $data['operation']['hour']->operation_hour_id }}">
                  <input type="hidden" name="venue_id" value="{{ $data['venue']->venue_id }}">
                  <input type="hidden" name="duration" value="{{ request()->duration }}">
                  <input type="hidden" name="date" value="{{ request()->date }}">
                  <input type="submit" class="button is-info" name="submit" value="Book Now">
                </p>
              </div>
            </div>

          </div>
          <!-- end control -->

        </div>
        <!-- end widget -->

      </div>
      <!-- end add on -->

    </div>
    <!-- end columns -->

  </form>

</div>
<!-- end container -->

<script type="text/javascript">

  $(document).ready(function(){

    $('#racquet').prop('disabled',true);
    $('#shuttlecock').prop('disabled',true);
    @if(old('gear_needed') == 'yes')

      $('#add-on-group').slideDown();
      $('#racquet').prop('disabled',false);
      $('#shuttlecock').prop('disabled',false);

    @endif
    $('#gear_needed').on('change',function(){

      //Check Gear Needed
      switch($(this).val()){

        //Yes
        case 'yes':
          $('#add-on-group').slideDown();
          $('#racquet').prop('disabled',false);
          $('#shuttlecock').prop('disabled',false);
        break;

        //Default
        default:
          $('#add-on-group').slideUp();
          $('#racquet').prop('disabled',true);
          $('#shuttlecock').prop('disabled',true);
        break;

      }
    });

  });

</script>
@endsection
