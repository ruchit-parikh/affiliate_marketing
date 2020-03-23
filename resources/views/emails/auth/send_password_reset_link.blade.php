@component('mail::message')

@component('mail::button', ['url' => route('v1.reset_password', ['token' => $token])])
{{ __('auth.reset_password_button') }}
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent