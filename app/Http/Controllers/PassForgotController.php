<?php

namespace App\Http\Controllers;

use App\Mail\RegisterMail;
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
            ->send(new RegisterMail(null));

        return redirect('/admin/agents/add')
            ->withInput($request->all())
            ->with('success', 'Agent ajouté avec succèss');

    }
}
