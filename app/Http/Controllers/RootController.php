<?php

namespace App\Http\Controllers;

use App\Mail\RegisterMail;
use App\Models\History;
use App\Models\Personne;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;

class RootController extends Controller
{

    public function showAdjointsView() {
        $title = 'MARIE GEST';
        $adjoints = User::where('role', 2)->where('delete', 0)->get();
        $current_action = explode('/', Route::current()->uri)[1];
        return view('pages.root.adjoints', compact('adjoints', 'title', 'current_action'));
    }


    public function showAddAdjointView() {
        $title = 'MARIE GEST';
        $adjoint_mode = 'add';
        $current_action = explode('/', Route::current()->uri)[1];
        return view('pages.root.adjoints', compact('adjoint_mode', 'title', 'current_action'));
    }

    public function showEditAdjointView(int $adjoint_id) {
        $title = 'MARIE GEST';
        $adjoint_mode = 'edit';
        $adjoint = User::find($adjoint_id);
        $current_action = explode('/', Route::current()->uri)[1];
        return view('pages.root.adjoints', compact('adjoint', 'adjoint_mode', 'title', 'current_action'));
    }


    /**
     * Fonction qui affiche les informations d'un tutilisateur.
     */
    public function showAdjointView (int $user_id) {
        $title = 'MARIE GEST';
        $adjoint_mode = 'edit';
        $adjoint = User::find($user_id);
        $current_action = explode('/', Route::current()->uri)[1];
        return view('pages.root.adjoint-manage.detail-adjoint', compact('adjoint', 'adjoint_mode', 'title', 'current_action'));
    }

    /**
     * Fonction qui permet de rediriger vers la page d'édition.
     */
    public function redirectToEditView (int $adjoint_id) {
        $adjoint = User::find($adjoint_id);
        $personne = $adjoint->personne;

        $adjoint_tab = $adjoint->toArray();
        $personne_tab = $personne->toArray();
        array_shift($personne_tab);

        $inputResult = array_merge($adjoint_tab, $personne_tab);

        return redirect("/" . strtolower(Auth::user()->role) . "/adjoints/$adjoint_id/edit")->withInput($inputResult);
    }

    /**
     * Fonction qui permet de faire la mis à jour d'un adjoint.
     */
    public function update_adjoint(Request $request, int $adjoint_id){

        $user = User::find($adjoint_id);
        $personne = $user->personne;

        $validation = Validator::make($request->all(), array_merge(Personne::$rules), ['service_id' => 'required']);

        if($validation->fails()){
            return redirect("/" . strtolower(Auth::user()->role) . "/adjoints/$adjoint_id/edit")
                ->withInput($request->all())
                ->withErrors($validation->errors());
        }

        // save Personne Elements.
        $personne->nom = $request->nom;
        $personne->prenom = $request->prenom;
        $personne->sexe = $request->sexe;
        $personne->email = $request->email;
        $personne->telephone = $request->telephone;
        $personne->cni = $request->cni;
        $personne->localisation = $request->localisation;
        $personne->status = $request->status;
        $personne->update();

        // HISTORY.
        $history = new History;
        $history->title = 'Modification d\'un  adjoint';
        $history->content = 'Les informations de l\'adjoint ' . $personne->nom . ' ' . $personne->prenom .' ont été modifiés ';
        $history->action_type = 5;
        $history->user_id = Auth::id();
        $history->save();

        return redirect('/'.strtolower(Auth::user()->role).'/adjoints')
            ->with('success', 'adjoint modifié avec succèss');
    }


    public function storeAdjoint(Request $request) {

        $validation = Validator::make($request->all(), array_merge(Personne::$rules), ['service_id' => 'required']);

        if($validation->fails()){
            return redirect('/'.strtolower(Auth::user()->role).'/adjoints/add')
                ->withInput($request->all())
                ->withErrors($validation->errors());
        }

        if(Personne::where('nom', $request->nom)->where('prenom', $request->prenom)->count() != 0){
            return redirect('/'.strtolower(Auth::user()->role).'/adjoints/add')
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
        $user = new User;
        $user->personne_id = $personne_id;
        $user->role = 2;
        $user->service_id = null;
        $user->profile = '/images/profiles/default_profile.png?h=100&w=100&fit=crop';
        $user->register_token = str_replace('/', '', bcrypt(AdminController::str_random(20)));
        $user->save();

        // HISTORY.
        $history = new History();
        $history->title = 'Ajout d\'un nouveau adjoint';
        $history->content = 'L\'adjoint ' . $personne->nom . ' ' . $personne->prenom .' à été ajouté dans la platefrome ';
        $history->action_type = 1;
        $history->user_id = Auth::id();
        $history->save();

        // TODO manage this to send the email.
        Mail::to($personne->email, $personne->nom . ' ' . $personne->prenom)
            ->send(new RegisterMail($user));

        return redirect('/'.strtolower(Auth::user()->role).'/adjoints/add')
            ->withInput($request->all())
            ->with('success', 'Adjoint ajouté avec succèss');
    }

    /**
     * Fonction qui permet de supprimer un adjoint.
     */
    public function deleteAdjoint(int $adjoint_id) {

        $adjoint  = User::find($adjoint_id);
        $adjoint->delete = 1;
        $adjoint->update();

        // HISTORY.
        $history = new History;
        $history->title = 'Suppression d\'un  adjoint';
        $history->content = 'L\'adjoint ' . $adjoint->personne->nom . ' ' . $adjoint->personne->prenom .' à été supprimé ';
        $history->action_type = 2;
        $history->user_id = Auth::id();
        $history->save();

        return redirect('/'.strtolower(Auth::user()->role).'/adjoints')->with('success', 'L\'adjoint à été supprimé avec succès.');

    }


}
