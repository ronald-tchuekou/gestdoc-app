<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Client\Request as ClientRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ResetPasswordController extends Controller
{
    public function index (String $token) {

        $user = User::where('reset_token', $token)->first();

        if($user == null){
            return response('', 401);
        }

        return view('auth.reset-password', compact('user'));
    }

    public function reset(int $id, Request $request){
        // Validation
        $errors = ['msg' => 'Une erreur s\'est produite.'];;
        $validation = Validator::make($request->all(), [
            'password' => 'required',
            'confirm_password' => 'required',
        ]);

        if($validation->fails()){
            $errors = ['msg' => 'Veuillez renseigner tous les champs du formulaire.'];
        }

        if($request->password !== $request->confirmPass){
            $errors = ['msg' => 'Le mot de pass de confirmation est différent.'];
        }

        $user = User::find($id);
        $user->password = Hash::make($request->password);
        $user->reset_token = null;

        if($user->update()){
            return redirect('login')->with('success', 'Mot de passe modifié avec succès, veuillez vous connecter.');
        }
        return redirect('/reset-password')->withErrors($errors)->withInput($request->all());
    }
}
