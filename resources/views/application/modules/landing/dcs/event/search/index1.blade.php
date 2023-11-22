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
          @foreach($data['slot']['available'] as $key=>$value)

             <tr>
                <td>{{ $value->venue_name }} [{{ ucwords(strtolower($value->venue_category)) }}]</td>
                <td align="center">{{ $value->time }}</td>
                <td align="right">
                  <a href="{{ route($hyperlink['page']['view'],['date'=>request()->date,'operation_hour_id'=>$value->operation_hour_id,'venue_id'=>$value->venue_id,'duration'=>request()->duration]) }}" class="btn">Select</a>
                </td>
             </tr>

          @endforeach
        </tbody>
      </table>
  </div>
</div>
@endsection
