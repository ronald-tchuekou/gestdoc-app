<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{

    /**
     * fonction qui permet de faire la mis à jour d'un mot de pass.
     */
    public function update_pass(Request $request) {

        $old_url = '/' . strtolower(Auth::user()->role) . '/profile';
        $input = ['type' => 'password'];

        // Valiation.
        $validate = Validator::make($request->all(), [
            'old_password' => 'required',
            'new_password' => 'required',
            'confirm_new_password' => 'required',
        ]);

        if($validate->fails()){
            return redirect($old_url)->withInput($input)->withErrors(['Vous devez renseigner tous les champs du formulaire.']);
        }

        $old_pass = $request->old_password;
        $new_pass = $request->new_password;
        $confirm_new_pass = $request->confirm_new_password;

        
        try {
            $user = User::find(Auth::id());
            
            if(!Hash::check($old_pass, $user->password)) {
                return redirect($old_url)
                    ->withInput($input)
                    ->withErrors(["L'acien mot de passe n'est pas correct."]);
            }

            if($new_pass != $confirm_new_pass) {
                return redirect($old_url)
                    ->withInput($input)
                    ->withErrors(['Le mot de passe de confirmation est différent du nouveau mot de passe.']);
            }

            $user->password = bcrypt($new_pass);
            $user->update();

            return redirect($old_url)
                ->withInput($input)
                ->with('success', 'Mot de passe mis à jour avec succès.');

        } catch (Exception $th) {
            return redirect($old_url)->withInput($input)->withErrors([$th->getMessage()]);
        }
        
    }

    /**
     * Fonction qui permet d'uploader une image de profile.
     */
    public function upload_profile (Request $request) {

        $redirectTo = '/' . strtolower(Auth::user()->role) . '/profile';

        //Check if the file are set or not.
        if (!$request->hasFile('profile')){
            return redirect($redirectTo)->withErrors(['Vous n\'avez pas selectionné d\'image.']);
        }
        
        // Validation.
        $validatedData = Validator::make($request->all(), [
            'profile' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:800',
        ]);
        
        // Check the validation.
        if($validatedData->fails()) {
            $errors = ["Le format de l'image n'est pas autorisé ou bien sa taille est supperieur à 800Ko. format autorisé : jpg,png,jpeg,gif,svg."];
            return redirect($redirectTo)->withErrors($errors);
        }
        
        $host_image = 'http://pictureapis.communedebanka.com/profiles/';
        
        $path = Storage::disk('ftp')->put('', $request->file('profile'));
        $image_path = $host_image . $path;
        
        $user = User::find(Auth::id());
        
        try {
            $old_image_path = explode('/', $user->profile)[4];
            $user->profile = $image_path;
    
            if($user->update() && Storage::disk('ftp')->exists($old_image_path)) {
                Storage::disk('ftp')->delete($old_image_path);
            }
        } catch (Exception $th) {
            $user->profile = $image_path;
            $user->update();
        } finally {
            return redirect($redirectTo)
                ->with('success', 'Votre profile à été mis à jour.');
        }
        
        
    }

}
