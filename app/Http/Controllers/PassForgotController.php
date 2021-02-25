<?php

namespace App\Http\Controllers;

use App\Mail\PassForgotMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class PassForgotController extends Controller
{
    public function index () {
        return view('auth.forgot-password');
    }

    /**
     * Fonction qui permet de transmetre un mail de réinitialisation de mot de passe.
     */
    public function sendMail(Request $request) {

        // Validation.
        $validate = Validator::make($request->all(), [
            'email' => 'required',
        ]);

        if($validate->fails()){
            return redirect('/forgot-password')
                ->withInput($request->all())
                ->withErrors($validate->errors());
        }

        // Get user with email.
        $user = User::where('login', $request->email)->first();

        if($user == null){
            return redirect('/forgot-password')
                ->withInput($request->all())
                ->withErrors(['Aucun utilisateur ne possède cette adresse email dans cette plateforme.']);
        }

        $reset_token = str_replace('/', '', bcrypt(AdminController::str_random(20)));
        $user->reset_token = $reset_token;
        $user->update();

        // TODO manage this to send the email.
        Mail::to($request->email, 'Mail de réinitialisation de mot de passe')
            ->send(new PassForgotMail($reset_token));

        return redirect('/forgot-password')
            ->withInput($request->all())
            ->with('success', 'Un mail vous à été envoie, consulté votre boite et réinitialisé votre compte.');
    }
}