@component('mail::message')
Salut à vous mr {{$firstName}} {{$lastName}}
@endcomponent

@component('mail::button', ['url' => $url, 'color' => 'success'])
Cliquer ici
@endcomponent

@component('mail::panel')
This is the panel content.
@endcomponent

