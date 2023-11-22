<!-- booking -->
<section class="section pb-0">

  <!-- container -->
  <div class="container">

    <!-- columns -->
    <div class="columns is-desktop is-multiline">
      <div class="column is-12-widescreen is-6-desktop mb-5">
        <h2 class="h5 section-title">Make a Booking</h2>
        <article class="card">

          <div class="card-body">

            <form class="" action="{{ route($hyperlink['page']['search']) }}" method="GET">

              <div class="columns">

                <div class="column">
                  <label class="label">Date</label>
                  <input class="input" type="date" id="date" name="date" value="{{ \Carbon\Carbon::tomorrow()->format('Y-m-d') }}" min="{{ \Carbon\Carbon::tomorrow()->format('Y-m-d') }}">
                </div>

                <div class="column">
                  <label class="label">Time</label>
                  <div class="select" style="width:100%;">
                    <select id="time" name="time" style="width:100%;">
                      <option option="">Please Select Date First</option>

                    </select>
                  </div>
                </div>

                <div class="column">
                  <label class="label">Duration (By Hour)</label>
                  <div class="select" style="width:100%;">
                    <select id="duration" name="duration" style="width:100%;">
                      <option option="">Please Select Duration</option>
                      <option option="">1</option>

                    </select>
                  </div>
                </div>

              </div>

              <div class="columns">
                <div class="column is-12">
                  <button class="button is-info" type="submit" name="button">Search</button>
                </div>
              </div/>

            </form>

          </div>

        </article>
      </div>

      <div class="column is-12">
        <div class="border-bottom border-default"></div>
      </div>

    </div>
    <!-- end columns -->

  </div>
  <!-- end container -->

</section>
<!-- end booking -->
<script>

$(document).ready(function(){

  $('#date').on('change',function(){

    //Set Header
    $.ajaxSetup({
      'headers':{
        'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
      }
    });

    //Set Request
      $.ajax({
        'type':'GET',
        'url':'{{ route($hyperlink['ajax']['get_date_day']) }}',
        'data':{'date':$('#date').val()},
        beforeSend:function(){

          //Clear Select Box
          $('#time').empty();

          //Set Loading
          $('#time').append($("<option value=''>Loading Operation Hour.....</option>"));

        },
        success:function(data){

          //Clear Select Box
          $('#time').empty();

          //Loop Data
          $.each(data.data,function(key,value) {
console.log(value['time']);

              //Set Data
              $('#time').append(

                  $("<option></option>").attr("value",value['time'])
                                        .text(value['time'])

              );

          });

        }

      });

  });
});


</script>
