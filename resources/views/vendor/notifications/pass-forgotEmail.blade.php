@component('mail::message')

Difficultés à se connecter? <br>

La réinitialisation de votre mot de passe est facile. <br>

Appuyez simplement sur le bouton ci-dessous et suivez les instructions. Nous vous aiderons à être opérationnel en un rien de temps.

@component('mail::button', ['url' => $url, 'color' => 'primary'])
Cliquer ici
@endcomponent

<p>
    Si le bouton ne marche pas, alors copier ce lien et coller dans un navigateur. <br>
    <span style="color: blue">{{$url}}</span>
</p>
Si vous n'avez pas fait cette demande, veuillez ignorer cet e-mail.
@endcomponent


