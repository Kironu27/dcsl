<!-- sidebar -->
<aside class="column is-4-desktop sidebar-home">

  <!-- about me -->
  <div class="widget widget-about">
    <h4 class="widget-title">Hi, {{ Auth::user()->name }}!</h4>
    <img class="img-fluid" src="
    @if(\Storage::disk()->exists('public\\users\\'.Session::get('guard').'\\'.Auth::guard(Session::get('guard'))->id().'\\avatar\\image.png'))
      {{ asset('storage\\users\\'.Session::get('guard').'\\'.Auth::guard(Session::get('guard'))->id().'\\avatar\\image.png') }}
    @else
      {{ asset('images\\avatar\\user.png') }}
    @endif
    " alt="Avatar">
  </div>
  <!-- end about me -->

  <!-- navigation -->
  <div class="widget widget-categories">
    <h4 class="widget-title"><span>Navigation</span></h4>

    <!-- home -->
    <div class="border-default collapse-wrapper">
      <a class="is-flex is-align-items-center p-2 collapse-head has-text-black">
        <i class="ti-home mr-3"></i>Home
      </a>
		</div>
    <!-- end home -->

    <!-- manage -->
    <div class="border-default collapse-wrapper">
      <a class="is-flex is-align-items-center p-2 collapse-head has-text-black" data-toggle="collapse" href="#collapse-manage" role="button" aria-expanded="false">
        <i class="ti-panel mr-3"></i>Manage <i class="ml-auto no-pointer ti-plus"></i>
      </a>
			<div class="collapse" id="collapse-manage" aria-expanded="false" style="display: none;">
        <ul>
          <li>
            <a href="{{ route($hyperlink['navigation']['authorization']['employee']['panel']['manage']['announcement']) }}" class="d-flex has-text-black">
              <i class="ti-angle-double-right mr-3"></i>Announcement</span>
            </a>
          </li>
          <li>
            <a href="{{ route($hyperlink['navigation']['authorization']['employee']['panel']['manage']['customer']) }}" class="d-flex has-text-black">
              <i class="ti-angle-double-right mr-3"></i>Customer</span>
            </a>
          </li>
          <li>
            <a href="{{ route($hyperlink['navigation']['authorization']['employee']['panel']['manage']['employee']) }}" class="d-flex has-text-black">
              <i class="ti-angle-double-right mr-3"></i>Employee</span>
            </a>
          </li>
        </ul>
			</div>
		</div>
    <!-- end manage -->

    <!-- setup -->
    <div class="border-default collapse-wrapper">
      <a class="is-flex is-align-items-center p-2 collapse-head has-text-black" data-toggle="collapse" href="#collapse-setup" role="button" aria-expanded="false">
        <i class="ti-panel mr-3"></i>Setup <i class="ml-auto no-pointer ti-plus"></i>
      </a>
			<div class="collapse" id="collapse-setup" aria-expanded="false" style="display: none;">
        <ul>
          <li>
            <a href="{{ route($hyperlink['navigation']['authorization']['employee']['panel']['setup']['sport']) }}" class="d-flex has-text-black">
              <i class="ti-angle-double-right mr-3"></i>Sport</span>
            </a>
          </li>
          <li>
            <a href="{{ route($hyperlink['navigation']['authorization']['employee']['panel']['setup']['operation_hour']) }}" class="d-flex has-text-black">
              <i class="ti-angle-double-right mr-3"></i>Operating Hour</span>
            </a>
          </li>
          <li>
            <a href="{{ route($hyperlink['navigation']['authorization']['employee']['panel']['setup']['venue']) }}" class="d-flex has-text-black">
              <i class="ti-angle-double-right mr-3"></i>Venue Category</span>
            </a>
          </li>
          <li>
            <a href="{{ route($hyperlink['navigation']['authorization']['employee']['panel']['setup']['venue_category']) }}" class="d-flex has-text-black">
              <i class="ti-angle-double-right mr-3"></i>Venue</span>
            </a>
          </li>
        </ul>
			</div>
		</div>
    <!-- end setup -->

    <!-- venue -->
    <div class="border-default collapse-wrapper">
      <a class="is-flex is-align-items-center p-2 collapse-head has-text-black" data-toggle="collapse" href="#collapse-venue" role="button" aria-expanded="false">
        <i class="ti-map-alt mr-3"></i>Venue <i class="ml-auto no-pointer ti-plus"></i>
      </a>
			<div class="collapse" id="collapse-venue" aria-expanded="false" style="display: none;">
        <ul>
          <li>
            <a href="{{ route($hyperlink['navigation']['authorization']['employee']['panel']['venue']['booking']['today']) }}" class="d-flex has-text-black">
              <i class="ti-angle-double-right ml-5 mr-3"></i>Today Booking</span>
            </a>
          </li>
          <li>
            <a href="{{ route($hyperlink['navigation']['authorization']['employee']['panel']['venue']['booking']['upcoming']) }}" class="d-flex has-text-black">
              <i class="ti-angle-double-right ml-5 mr-3"></i>Upcoming Booking</span>
            </a>
          </li>
          <li>
            <a href="{{ route($hyperlink['navigation']['authorization']['employee']['panel']['venue']['booking']['previous']) }}" class="d-flex has-text-black">
              <i class="ti-angle-double-right ml-5 mr-3"></i>Previous Booking</span>
            </a>
          </li>
        </ul>
			</div>
		</div>
    <!-- end venue -->

    <!-- equipment -->
    <div class="border-default collapse-wrapper">
      <a class="is-flex is-align-items-center p-2 collapse-head has-text-black" data-toggle="collapse" href="#collapse-equipment" role="button" aria-expanded="false">
        <i class="ti-basketball mr-3"></i>Equipment <i class="ml-auto no-pointer ti-plus"></i>
      </a>
			<div class="collapse" id="collapse-equipment" aria-expanded="false" style="display: none;">
        <ul>
          <li>
            <a href="{{ route($hyperlink['navigation']['authorization']['employee']['panel']['equipment']['ball']) }}" class="d-flex has-text-black">
              <i class="ti-angle-double-right ml-5 mr-3"></i>Ball</span>
            </a>
          </li>
          <li>
            <a href="{{ route($hyperlink['navigation']['authorization']['employee']['panel']['equipment']['racquet']) }}" class="d-flex has-text-black">
              <i class="ti-angle-double-right ml-5 mr-3"></i>Racquet</span>
            </a>
          </li>
        </ul>
			</div>
		</div>
    <!-- end equipment -->

  </div>
  <!-- end navigation -->

</aside>
<!-- end sidebar -->
