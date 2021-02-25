<?php

namespace App\Http\Controllers;

use App\Mail\PassForgotMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class PassForgotController extends Controller
{
    public function index () {
        return view('auth.forgot-password');
    }

    /**
     * Fonction qui permet de transmetre un mail de réinitialisation de mot de passe.
     */
    public function sendMail(Request $request) {

        dd($request->all());

        // TODO manage this to send the email.
        Mail::to('Mot de passe oublié', 'Mail de réinitialisation de mot de passe')
            ->send(new PassForgotMail(''));

        return redirect('/forgot-password')
            ->withInput($request->all())
            ->with('success', 'Un mail vous à été envoie, consulté votre boite et réinitialisé votre compte.');
    }
}
