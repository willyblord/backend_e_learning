@component('mail::message')
# Reset Password
<img src='https://smartapplicationsgroup.com/kenya/images/smart_logo.jpg'><br>
Reset or change your password.
@component('mail::button', ['url' => 'http://localhost:4200/changepassword?token='.$token])
Change Password
@endcomponent
Thanks,<br>
{{ config('app.name') }}
@endcomponent
