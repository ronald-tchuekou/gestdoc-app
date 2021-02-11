<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function index ($id, $token) {

        $user = User::where('id', $id)->where('register_token', $token)->first();

        if($user == null){
            return response('', 401);
        }

        return view('auth.register', compact('user'));
    }

    public function store (Request $request, int $id) {
        
        // Validation
        $errors = ['msg' => 'Une erreur s\'est produite.'];;
        $validation = Validator::make($request->all(), [
            'login' => 'required',
            'password' => 'required',
            'confirmPass' => 'required',
        ]);
        
        if($validation->fails()){
            $errors = ['msg' => 'Veuillez renseigner tous les champs du formulaire.'];
        }

        if($request->password !== $request->confirmPass){
            $errors = ['msg' => 'Le mot de pass de confirmation est différent.'];
        }

        $user = User::find($id);
        $user->login = $request->login;
        $user->password = bcrypt($request->password);
        $user->register_token = null;

        if($user->update()){
            return redirect('login')->with('success', 'Inscrit avec succès, veuillez vous connecter.');
        }
        return redirect('register')->withErrors($errors)->withInput($request->all());
    }
}
