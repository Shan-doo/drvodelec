@component('mail::message')

#Poštovani, {{ $username }}

Uspešno ste se registrovali na {{ config('app.name')}} .<br>

@component('mail::button', ['url' => config('app.url') ])

Odgovor

@endcomponent

@component('mail::panel', ['url' => ''])

Deserunt pariatur dolor ut irure laboris ad sunt consequat cupidatat aliquip minim reprehenderit magna fugiat cillum minim.

@endcomponent

Thanks,<br>

{{ config('app.name') }}

@endcomponent