<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use GuzzleHttp\Psr7\UploadedFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    
    /**
     * fonction qui permet de faire la mis à jour d'un mot de pass.
     */
    public function update_pass(Request $request) {

        dd('827ccb0eea8a706c4c34a16891f84e7b' == hash('md5', $request->password));

        $old_path = '/' . strtolower(Auth::user()->role) . '/profile';
        $input = ['type' => 'password'];

        // Valiation.
        $validate = Validator::make($request->all(), [
            'old_password' => 'required',
            'new_password' => 'required',
            'confirm_new_password' => 'required',
        ]);

        if($validate->fails()){
            return redirect($old_path)->withInput($input)->withErrors(['Vous devez renseigner tous les champs du formulaire.']);
        }

        $old_pass = hash('md5', $request->old_password);
        $new_pass = hash('md5', $request->new_password);
        $confirm_new_pass = hash('md5', $request->confirm_new_password);

        try {
            $user = User::find(Auth::user()->id);
            if($user->password != $old_pass) {
                return redirect($old_path)
                    ->withInput($input)
                    ->withErrors(["L'acien mot de passe n'est pas correct."]);
            }

            if($new_pass != $confirm_new_pass){
                return redirect($old_path)
                    ->withInput($input)
                    ->withErrors(['Le mot de passe de confirmation est différent du nouveau mot de passe.']);
            }

            $user->password = $new_pass;
            $user->update();

            return redirect($old_path)
                ->withInput($input)
                ->with('success', 'Mot de passe mis à jour avec succès.');

        } catch (Exception $th) {
            return redirect($old_path)->withInput($input)->withErrors([$th->getMessage()]);
        }
        
    }

    /**
     * Fonction qui permet d'uploader une image de profile.
     */
    public function upload_profile (Request $request) {

        $old_path = '/' . strtolower(Auth::user()->role) . '/profile';

        $validatedData = Validator::make($request->all(), [
            'profile' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:800',
        ]);

        if($validatedData->fails()) {
            $errors = ["Le format de l'image n'est pas autorisé ou bien sa taille est supperieur à 800Ko. format autorisé : jpg,png,jpeg,gif,svg."];
            return redirect($old_path)->withErrors($errors);
        }

        $ext = $request->profile->clientExtension();
        $milliseconds = round(microtime(true) * 1000);
        
        $path = $request->file('profile')->storeAs('', $milliseconds . '.' . $ext);

        $user = User::find($request->user_id);
        $user->profile = '/images/' . $path;
        $user->update();

        return redirect($old_path)->with('success', 'Votre profile à été mis à jour.');
    }
    
}
