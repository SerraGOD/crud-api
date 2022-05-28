@component('mail::message')
# Email 4 created client

The client was created.

@component('mail::button', ['url' => ''])
No hace nada
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
