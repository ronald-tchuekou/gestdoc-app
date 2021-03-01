@component('mail::message')
Salut à vous @if($sexe == 'Masculin') Mr @else Mme @endif {{$firstName}} {{$lastName}}<br/>
Afin de terminer la creation de votre compte de gestionnaire sur la plate forme de gestion des courriers de la Mairie de Banka, Cliquer sur le bouton/lien suivant.

@component('mail::button', ['url' => $url, 'color' => 'primary'])
Cliquer ici
@endcomponent

<p>
    Si le bouton ne marche pas, alors copier ce lien et coller dans un navigateur. <br>
    <span style="color: blue">{{$url}}</span>
</p>
@endcomponent
