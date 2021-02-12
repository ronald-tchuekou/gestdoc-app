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
        try {
            $user = User::find($request->user_id);
            if($user->password != $request->old_pass) {
                return response("L'acien mot de passe n'est pas correct.", 201);
            }
            $user->passowrd = $request->new_pass;
            $user->update();
            return response('', 200);
        } catch (Exception $th) {
            return response($th);
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
