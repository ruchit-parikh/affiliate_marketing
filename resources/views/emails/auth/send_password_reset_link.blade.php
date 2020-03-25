@component('mail::message')

<span style="text-align: center">You can reset your password by clicking on below button!</span><br><br>
@component('mail::button', ['url' => route('v1.reset_password', ['token' => $token])])
{{ __('auth.reset_password_button') }}
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent