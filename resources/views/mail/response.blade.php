@component('mail::message')

#Poštovani, {{ $sender }}

Dobili ste odgovor od {{ config('app.name')}} povodom vašeg pitanja "{{ $subject }}".<br>

Odgovor pročitajte na sledećem linku.

@component('mail::button', ['url' => action('IndexController@index', ['token' => $conversationToken, 'conv' => $conversationId])])

Odgovor

@endcomponent

@component('mail::panel', ['url' => ''])

Deserunt pariatur dolor ut irure laboris ad sunt consequat cupidatat aliquip minim reprehenderit magna fugiat cillum minim.

@endcomponent

Thanks,<br>

{{ config('app.name') }}

@endcomponent