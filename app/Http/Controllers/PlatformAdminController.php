<?php

namespace App\Http\Controllers;

use App\Mail\RegisterMail;
use App\Models\History;
use App\Models\Location;
use App\Models\Personne;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class PlatformAdminController extends Controller
{

    public function index () 
    {
        $current_action = 'Gestionnaire d\'utilisateurs';
        $title = strtoupper(Auth::user()->role)  .  ' GEST';
        $root_users = User::where('role', 3)->where('deleted', 0)->get();
        $accueil_users = User::where('role', 4)->where('deleted', 0)->get();
        return view('pages.paltform-administrator.index', compact('root_users', 'accueil_users', 'current_action', 'title'));
    }

    public function showAddRootView () {
        $current_action = 'Ajout d\'un nouveau super user';
        $title = strtoupper(Auth::user()->role)  .  ' GEST';
        $action_form = "/" . strtolower(Auth::user()->role) . "/root-manager/store";
        $locations = Location::all();
        return view('pages.paltform-administrator.root-manager.add-root-user', compact('locations', 'action_form', 'current_action', 'title'));
    }

    public function showAddAccueilView () {
        $current_action = 'Ajout d\'un nouveau service d\'accueil';
        $title = strtoupper(Auth::user()->role)  .  ' GEST';
        $action_form = "/" . strtolower(Auth::user()->role) . "/accueil-manager/store";
        $locations = Location::all();
        return view('pages.root.accueil-manager.add-accueil-user', compact('locations', 'action_form', 'current_action', 'title'));
    }

    public function showEditRootView (int $id) {
        $current_action = 'Modification d\'un super user';
        $title = strtoupper(Auth::user()->role)  .  ' GEST';
        $action_form = "/" . strtolower(Auth::user()->role) . "/root-manager/" . $id . "/update";
        $personne = Personne::find($id);
        $locations = Location::all();
        return view('pages.paltform-administrator.root-manager.edit-root-user', compact('personne', 'locations', 'action_form', 'current_action', 'title'));
    }

    public function showEditAccueilView (int $id) {
        $current_action = 'Modification d\'un service d\'accueil';
        $title = strtoupper(Auth::user()->role)  .  ' GEST';
        $action_form = "/" . strtolower(Auth::user()->role) . "/accueil-manager/" . $id . "/update";
        $user = User::find($id);
        $personne = Personne::find($user->personne_id);
        $locations = Location::all();
        return view('pages.root.accueil-manager.edit-accueil-user', compact('personne', 'locations', 'action_form', 'current_action', 'title'));
    }

    /**
     * fonction to save the root account.
     */
    public function storeRootAccount (Request $request) {
        return $this->store_user($request, 3);
    }

    /**
     * fonction to save the home service account.
     */
    public function storeAccueilAccount (Request $request) {
        return $this->store_user($request, 4);
    }

    /**
     * Fonction that store all information about personne.
     */
    private function store_user (Request $request, int $role){
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
        $personne->localisation = $request->localisation;
        $personne->status = $request->status;
        $personne_id = DB::table('personnes')->insertGetId($personne->toArray());

        // Send email to this personne.
        $user = new User();
        $user->personne_id = $personne_id;
        $user->role = $role;
        $user->couriers_access_categories = "all";
        $user->profile = '/images/profiles/default_profile.png?h=100&w=100&fit=crop';
        $user->register_token = str_replace('/', '', bcrypt(AdminController::str_random(20)));
        $user->save();

        // HISTORY.
        $history = new History;
        $history->title = 'Ajout d\'un nouveau super user (maire)';
        $history->content = 'Le Maire ' . $personne->sexe == 'Masculin' ? 'Mr' : 'Mme' . $personne->nom . ' ' . $personne->prenom .' à été ajouté dans la platefrome ';
        $history->action_type = 1; // Pour l'ajout.
        $history->user_id = Auth::id();
        $history->save();

        // TODO manage this to send the email.
        Mail::to($personne->email, $personne->nom . ' ' . $personne->prenom)
            ->send(new RegisterMail($user));

        return back()
            ->withInput($request->all())
            ->with('success', 'Utilisateur ajouté avec succèss');
    }

    /**
     * Fonction to update root account.
     */
    public function updateAccount (Request $request, int $id){
        $personne = Personne::find($request->personne_id);

        $personne->nom = $request->nom;
        $personne->prenom = $request->prenom;
        $personne->sexe = $request->sexe;
        $personne->email = $request->email;
        $personne->telephone = $request->telephone;
        $personne->cni = $request->cni;
        $personne->localisation = $request->localisation;
        $personne->status = $request->status;
        $personne->update();

        $user = User::find($id);
        if($user->role == 'Agent'){
            $user->couriers_access_categories = "all";
        }
        $user->update();

        return redirect('platfrom-administrator')
            ->with('success', 'Utilisateur modifié avec succèss');
    }

    /**
     * Fonction to delete an user.
     */
    public function deleteUser (int $id) {
        $user = User::find($id);

        if($user->login == null) {
            $user->delete();
        }
        else {
            $user->deleted = 1;
            $user->update();
        }
        return back()
        ->with('success', 'Utilisateur supprimé avec succèss');
    }
    
}
