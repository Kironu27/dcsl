<p>
  Hi {{ $data['main']['name'] }},
</p>

<p>
Your Payment Code is: {{ $data['main']['code'] }}
</p>




{{-- Sub Copy --}}
@component('mail::subcopy')

  <p class="text-center" style= "text-align: center;">
   You are receiving this message as an automated confirmation of your request to Reset Password.
  </p>
  <p class="text-center" style= "text-align: center;">
  Any problem you may email to us at support@dcsl.com.
</p>

@endcomponent
{{-- End Sub Copy --}}

{{-- Footer --}}
@slot('footer')
 @component('mail::footer')
 Copyright  ©{{ \Carbon\Carbon::now()->format('Y') }} Daimon Sport Center.
 @endcomponent
@endslot
{{-- End Footer --}}
