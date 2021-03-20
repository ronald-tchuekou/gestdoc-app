<?php

namespace App\Http\Controllers;

use App\Models\Personne;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
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

    public function registerAdministratorPersonView () {
        return view('auth.admin-register-person');
    }

    public function registerAdministratorView () {
        return view('auth.admin-register');
    }

    public function store (Request $request, int $id) {

        // Validation
        $errors = ['msg' => 'Une erreur s\'est produite.'];;
        $validation = Validator::make($request->all(), [
            'login' => 'required',
            'password' => 'required|min:8',
            'confirmPass' => 'required|min:8',
        ]);

        if($validation->fails()){
            $errors = $validation->errors();
        }

        if($request->password !== $request->confirmPass){
            $errors = ['msg' => 'Le mot de pass de confirmation est différent.'];
        }

        $user = User::find($id);
        $user->login = $request->login;
        $user->password = Hash::make($request->password);
        $user->register_token = null;

        if($user->update()){
            return redirect('login')->with('success', 'Inscrit avec succès, veuillez vous connecter.');
        }
        return redirect('register')->withErrors($errors)->withInput($request->all());
    }

    /**
     * Function to store the platform adminstrator to the database.
     */
    public function storeAdministrator (Request $request) 
    {

        // Validation
        $errors = ['msg' => 'Une erreur s\'est produite.'];;
        $validation = Validator::make($request->all(), [
            'login' => 'required',
            'password' => 'required|min:8',
            'confirm_password' => 'required|min:8',
        ]);

        if($validation->fails()){
            $errors = $validation->errors();
        }else if($request->password !== $request->confirm_password){
            $errors = ['msg' => 'Le mot de pass de confirmation est différent.'];
        }else{
            $user = new User;
            $user->login = $request->login;
            $user->password = Hash::make($request->password);
            $user->role = 5;
            $user->personne_id = session('personne_id');
            $user->profile = '/images/profiles/default_profile.png?h=100&w=100&fit=crop';
            if($user->save()){
                return redirect('login')
                    ->with('success', 'Votre compte à été créé avec succès, veuillez-vous connecter pour commencer la configuration de la platforme.');
            }else{
                $errors = ["Une erreur s'est produite, veuillez reéssayer de nouveau."];
            }
        }

        return back()
            ->withErrors($errors)
            ->withInput($request->input());
    }

    
    /**
     * Function to store the platform adminstrator personal infor into the database.
     */
    public function storeAdministratorPerson (Request $request) 
    {

        $validation = Validator::make($request->all(), array_merge(Personne::$rules));

        if($validation->fails()){
            return back()
                ->withInput($request->all())
                ->withErrors($validation->errors());
        }

        if(Personne::where('nom', $request->nom)->where('prenom', $request->prenom)->count() != 0){
            return back()
                ->withInput($request->all())
                ->withErrors(['Utilisateur possède déjà ces informations dans le système.']);
        }

        // save Personne Elements.
        $personne = new Personne;
        $personne->nom = $request->nom;
        $personne->prenom = $request->prenom;
        $personne->sexe = $request->sexe;
        $personne->email = $request->email;
        $personne->telephone = $request->telephone;
        $personne->cni = $request->cni;
        $personne_id = DB::table('personnes')->insertGetId($personne->toArray());

        if($personne_id >= 1){
            session(['personne_id' => $personne_id]);
            return redirect('admin-register')
                ->with('success', 'Votre compte à été créé avec succès, veuillez indiquer votre login et mot de passe.');
        }else{
            $errors = ["Une erreur s'est produite, veuillez reéssayer de nouveau."];
            return back()
                ->withErrors($errors)
                ->withInput($request->input());
        }

    }
}
