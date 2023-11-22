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

    <!-- my account -->
    <div class="border-default collapse-wrapper">
      <a class="is-flex is-align-items-center p-2 collapse-head has-text-black" data-toggle="collapse" href="#collapse-account" role="button" aria-expanded="false">
        <i class="ti-panel mr-3"></i>My Account <i class="ml-auto no-pointer ti-plus"></i>
      </a>
			<div class="collapse" id="collapse-account" aria-expanded="false" >
        <ul>
          <li>
            <a href="{{ route($hyperlink['navigation']['authorization']['customer']['panel']['account']['avatar']) }}" class="d-flex has-text-black">
              <i class="ti-angle-double-right mr-3"></i>Avatar</span>
            </a>
          </li>
          <li>
            <a href="{{ route($hyperlink['navigation']['authorization']['customer']['panel']['account']['profile']) }}" class="d-flex has-text-black">
              <i class="ti-angle-double-right mr-3"></i>Profile</span>
            </a>
          </li>
          <li>
            <a href="{{ route($hyperlink['navigation']['authorization']['customer']['panel']['account']['change_password']) }}" class="d-flex has-text-black">
              <i class="ti-angle-double-right mr-3"></i>Change Password</span>
            </a>
          </li>
        </ul>
			</div>
		</div>
    <!-- end my account -->

    <!-- booking -->
    <div class="border-default collapse-wrapper">
      <a class="is-flex is-align-items-center p-2 collapse-head has-text-black" data-toggle="collapse" href="#collapse-booking" role="button" aria-expanded="false">
        <i class="ti-panel mr-3"></i>Booking <i class="ml-auto no-pointer ti-plus"></i>
      </a>
			<div class="collapse" id="collapse-booking" aria-expanded="false">
        <ul>
          <li>
            <a href="{{ route($hyperlink['navigation']['authorization']['customer']['panel']['booking']['active']) }}" class="d-flex has-text-black">
              <i class="ti-angle-double-right mr-3"></i>Active</span>
            </a>
          </li>
          <li>
            <a href="{{ route($hyperlink['navigation']['authorization']['customer']['panel']['booking']['history']) }}" class="d-flex has-text-black">
              <i class="ti-angle-double-right mr-3"></i>History</span>
            </a>
          </li>
        </ul>
			</div>
		</div>
    <!-- end booking -->

  </div>
  <!-- end navigation -->

</aside>
<!-- end sidebar -->
