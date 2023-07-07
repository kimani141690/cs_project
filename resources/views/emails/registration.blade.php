<x-mail::message>
# Dear {{$user}},
<br>
We are pleased to inform you that your account registration request has been completed. You can now log in to our system
using the following credentials:
<br>
@component('mail::panel')
**Username:** {{$user_email}}
<br>
**Temporary Password:** {{$user_password}}
@endcomponent
Please note that for security purposes, we recommend you promptly reset your password upon logging in.

@component('mail::button', ['url' => 'http://127.0.0.1:8000/auth/registration/' . $token])
Reset Password
@endcomponent

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
