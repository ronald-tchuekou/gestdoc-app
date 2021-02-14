<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use League\Flysystem\Filesystem;
use League\Flysystem\Adapter\Ftp as Adapter;

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

        $validatedData = Validator::make($request->all(), [
            'profile' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:800',
        ]);

        if($validatedData->fails()) {
            $errors = ["Le format de l'image n'est pas autorisé ou bien sa taille est supperieur à 800Ko. format autorisé : jpg,png,jpeg,gif,svg."];
            return redirect($redirectTo)->withErrors($errors);
        }

        $ext = $request->profile->clientExtension();
        $milliseconds = round(microtime(true) * 1000);
        $name = $milliseconds . '.' . $ext;
        
        $path = Storage::putFileAs('', $request->file('profile'), $name, 'ftp');
        $image_path = '/images/' . $path . '?w=100&h=100&fit=crop';
        
        $user = User::find($request->user_id);
        $user->profile = $image_path;

        if(Storage::disk('ftp')->exists($user->profile) and $user->update()) {
            Storage::disk('ftp')->delete($user->profile);
        }
        
        return redirect($redirectTo)->with('success', 'Votre profile à été mis à jour.');
    }


    public function getimage (Request $request) {
        $filesystem = new Filesystem(new Adapter([
            'host' => '185.98.131.159',
            'username' => '1452369OnbrQx ',
            'password' => 'hE5!mVcuGm',
        
            /** optional config settings */
            'port' => 21,
            'root' => '/path/to/root',
            'passive' => true,
            'ssl' => true,
            'timeout' => 30,
            'ignorePassiveAddress' => false,
        ]));

         return $filesystem->readStream('/profiles/');
    }


    
}
