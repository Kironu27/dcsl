@extends(Config::get('routing.application.modules.landing.dcs.layout').'.structure.index')

@section('main-content')

<div class="container pt-5 mt-5">
  <div class="content">
      <table class="table is-full">
        <thead>
           <tr>
              <th style="width:60%">Venue</th>
              <th align="center">Time</th>
              <th align="right">Action</th>
           </tr>
        </thead>
        <tbody>
          @php
              $desiredDuration = request()->duration; // Set the desired duration in hours
              @endphp

          @foreach($data['slot']['available'] as $key=>$value)
              @php
                  $startTime = $value->time;
                  $endTime = date('H:i', strtotime("+".request()->duration." hours", strtotime($startTime)));
                  $isBooked = $value->is_booked;
              @endphp

              {{-- Check if the time slot is not booked and the desired duration can be accommodated --}}
              @if (!$isBooked && checkDurationAvailability($data['slot']['available'], $value->venue_id, $startTime, $endTime))
                  <tr>
                      <td>{{ $value->venue_name }} [{{ ucwords(strtolower($value->venue_category)) }}]</td>
                      <td align="center">{{ $startTime }} - {{ $endTime }}</td>
                      <td align="right">
                          <a href="{{ route($hyperlink['page']['view'], ['date'=>request()->date,'operation_hour_id'=>$value->operation_hour_id,'venue_id'=>$value->venue_id,'duration'=>$desiredDuration]) }}" class="btn">Select</a>
                      </td>
                  </tr>
              @endif
          @endforeach

          @php
          function checkDurationAvailability($slots, $venueId, $startTime, $endTime) {
              foreach ($slots as $slot) {
                  if ($slot->venue_id == $venueId && $slot->is_booked) {
                      $bookedStartTime = $slot->time;
                      $bookedEndTime = date('H:i', strtotime("+".request()->duration." hours", strtotime($bookedStartTime)));
                      if (($startTime >= $bookedStartTime && $startTime < $bookedEndTime) || ($endTime > $bookedStartTime && $endTime <= $bookedEndTime)) {
                          return false; // Duration not available, overlapping with a booked slot
                      }
                  }
              }
              return true; // Duration available
          }
          @endphp
        </tbody>
      </table>
  </div>
</div>
@endsection
