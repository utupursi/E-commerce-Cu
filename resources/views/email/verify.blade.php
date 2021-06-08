@component('mail::message')
# Verify
This Message is valid till {{Carbon\Carbon::now()->addDays(1)}}

@component('mail::button', ['url' => url('/').'/verifyaccount/'.$userid.'|'.$token])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
