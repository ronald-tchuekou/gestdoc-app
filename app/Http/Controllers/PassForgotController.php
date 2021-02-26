<?php

namespace App\Http\Controllers;

use App\Mail\PassForgotMail;
use App\Models\Personne;
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
        $personne = Personne::where('email', $request->email)->first();
        if($personne != null){
            $user = $personne->user;
            if($user == null){
                return redirect('/forgot-password')
                    ->withInput($request->all())
                    ->withErrors(['Vous n\'est pas un utilisateur dans cette plateforme.']);
            }

            $reset_token = str_replace('/', '', bcrypt(AdminController::str_random(20)));
            $user->reset_token = $reset_token;
            $user->update();

            // TODO manage this to send the email.
            Mail::to($request->email, 'Mail de réinitialisation de mot de passe')
                ->send(new PassForgotMail($reset_token));

            return redirect('/forgot-password')
                ->with('success', 'Un mail vous à été envoie, consulté votre boite et réinitialisé votre compte.');
        }else{
            return redirect('/forgot-password')
                ->withInput($request->all())
                ->withErrors(['Aucun utilisateur de la plateforme de possède cette adresse email.']);
        }
    }
}
