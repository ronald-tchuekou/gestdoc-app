<?php

namespace App\Http\Controllers;

use App\Events\NotifyEvent;
use App\Mail\RegisterMail;
use App\Models\Assigne;
use App\Models\Categorie;
use App\Models\Courier;
use App\Models\CourierValide;
use App\Models\History;
use App\Models\Location;
use App\Models\Personne;
use App\Models\Reject;
use App\Models\Service;
use App\Models\ToModify;
use App\Models\User;
use App\Models\Utils;
use DateInterval;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{

    public function index () {
        $title = strtoupper(Auth::user()->role)  .  'GEST';
        $current_account =  'admin';
        $user = Auth::user();
        $current_action = explode('/', Route::current()->uri)[1];

        $c_t = Courier::where('etat', 3)->orWhere('etat', 2)->get();
        $a_c_t = [];
        $a_p = [];
        foreach($c_t as $courier) {
            array_push($a_c_t, $courier->assignes()->where('terminer', 1)->first());
            $tc = $courier->assignes()->where('terminer', 2)->count();
            $t = $courier->assignes()->count();
            array_push($a_p, ($tc/$t) * 100);
        }

        // HISTORIES.
        $histories = History::orderBy('created_at', 'DESC')->limit(5)->get();

        return view('pages.admin.index', compact('histories', 'a_p', 'c_t', 'a_c_t','user', 'title', 'current_account', 'current_action'));
    }

    public function showProfileView() {
        $title = strtoupper(Auth::user()->role)  .  'GEST';
        $current_account =  'admin';
        $user = Auth::user();
        $cat = $user->couriers_access_categories;
        if($cat == "all"){
            $categories = Categorie::all();
        }else {
            $categories = Categorie::whereIn('id', json_decode($cat))->get();
        }
        $current_action = explode('/', Route::current()->uri)[1];
        return view('pages.admin.profile', compact('categories', 'user', 'title', 'current_account', 'current_action'));
    }

    public function showParametresView() {
        $title = strtoupper(Auth::user()->role)  .  'GEST';
        $current_account =  'admin';
        $user = Auth::user();
        $current_action = explode('/', Route::current()->uri)[1];
        return view('pages.admin.parametres', compact('user', 'title', 'current_account', 'current_action'));
    }

    public function showAgentsView() {
        $title = strtoupper(Auth::user()->role)  .  'GEST';
        $current_account =  'admin';
        $agents = User::where('role', 1)->where('deleted', 0)->get();
        $services = Service::all();
        $user = Auth::user();
        $current_action = explode('/', Route::current()->uri)[1];
        return view('pages.admin.agents', compact('user', 'services', 'agents', 'title', 'current_account', 'current_action'));
    }

    public function showAddAgentView() {
        $title = strtoupper(Auth::user()->role)  .  'GEST';
        $current_account =  'admin';
        $agent_mode = 'add';
        $user = Auth::user();
        $services = Service::all();
        $locations = Location::all();
        $current_action = explode('/', Route::current()->uri)[1];
        return view('pages.admin.agents', compact('locations', 'user', 'services', 'agent_mode', 'title', 'current_account', 'current_action'));
    }

    public function showAllActivities() {
        $title = strtoupper(Auth::user()->role)  .  'GEST';
        $current_account =  'admin';
        $agent_mode = 'add';
        $user = Auth::user();

        // HISTORIES.
        $histories = History::orderBy('created_at', 'DESC')->get();

        $current_action = 'tous les activités';
        return view('pages.all-activities', compact('user', 'histories', 'agent_mode', 'title', 'current_account', 'current_action'));
    }

    public function showEditAgentView(int $agent_id) {
        $title = strtoupper(Auth::user()->role)  .  'GEST';
        $current_account =  'admin';
        $agent_mode = 'edit';
        $user = Auth::user();
        $agent = User::find($agent_id);
        $services = Service::all();
        $locations = Location::all();
        $current_action = explode('/', Route::current()->uri)[1];
        return view('pages.admin.agents', compact('locations', 'agent', 'services', 'user', 'agent_mode', 'title', 'current_account', 'current_action'));
    }

    /**
     * Fonction qui affiche les informations d'un tutilisateur.
     */
    public function showAgentView (int $user_id) {
        $title = strtoupper(Auth::user()->role)  .  'GEST';
        $current_account =  'admin';
        $agent_mode = 'edit';
        $user = Auth::user();
        $agent = User::find($user_id);
        $current_action = explode('/', Route::current()->uri)[1];
        return view('pages.admin.agent-manage.detail-agent', compact('agent', 'user', 'agent_mode', 'title', 'current_account', 'current_action'));
    }

    /**
     * Fonction qui permet de faire la mis à jour d'un agent.
     */
    public function update_agent(Request $request, int $agent_id){

        $user = User::find($agent_id);
        $personne = $user->personne;

        $validation = Validator::make($request->all(), array_merge(Personne::$rules), ['service_id' => 'required']);

        if($validation->fails()){
            return back()
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
        $history->title = 'Modification d\'un  agent';
        $history->content = 'Les informations de l\'agent ' . $personne->nom . ' ' . $personne->prenom .' ont été modifiés ';
        $history->action_type = 5;
        $history->user_id = Auth::id();
        $history->save();

        return redirect('/'.strtolower(Auth::user()->role).'/agents')
            ->with('success', 'Agent modifié avec succèss');
    }

    public function storeAgent(Request $request) {

        $validation = Validator::make($request->all(), array_merge(Personne::$rules), ['service_id' => 'required']);

        if($validation->fails()){
            return redirect('/'.strtolower(Auth::user()->role).'/agents/add')
                ->withInput($request->all())
                ->withErrors($validation->errors());
        }

        if(Personne::where('nom', $request->nom)->where('prenom', $request->prenom)->count() != 0){
            return redirect('/'.strtolower(Auth::user()->role).'/agents/add')
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
        $user->service_id = $request->service_id;
        $user->profile = '/images/profiles/default_profile.png?h=100&w=100&fit=crop';
        $user->register_token = str_replace('/', '', bcrypt($this->str_random(20)));
        $user->save();

        // HISTORY.
        $history = new History;
        $history->title = 'Ajout d\'un nouveau agent';
        $history->content = 'L\'agent ' . $personne->nom . ' ' . $personne->prenom .' à été ajouté dans la platefrome ';
        $history->action_type = 1;
        $history->user_id = Auth::id();
        $history->save();


        // TODO manage this to send the email.
        Mail::to($personne->email, $personne->nom . ' ' . $personne->prenom)
            ->send(new RegisterMail($user));

        return redirect('/'.strtolower(Auth::user()->role).'/agents/add')
            ->withInput($request->all())
            ->with('success', 'Agent ajouté avec succèss');
    }

    /**
     * fonction qui permet de générer une chaine de caractères.
     */
    public static function str_random($length = 16)
    {
        $pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

        return substr(str_shuffle(str_repeat($pool, 5)), 0, $length);
    }

    /**
     * Fonctoin qui retourne les statistique des courriers en un intervalle de temps.
     */
    public function get_statCourrierBetween (String $from="none") {

        try{
            $to_date = now();
            $from_date = $from != "none" ? $from : strtotime(Utils::simple_date_format($to_date). ' + 7 days');

            $courriers = Courier::whereBetween('dateEnregistrement', [$from_date, $to_date])->get();
            $total = $courriers->count();
            $total_valide =  $courriers->filter(function($item){
                if($item->etat == 'Validé'){
                    return $item;
                }
            })->count();
            $total_traite =  $courriers->filter(function($item){
                if($item->etat == 'Traité'){
                    return $item;
                }
            })->count();
            $total_reject =  $courriers->filter(function($item){
                if($item->etat == 'Reject'){
                    return $item;
                }
            })->count();

            $tab = Array(
                'total' => $total,
                'valide' => $total_valide,
                'traite' => $total_traite,
                'reject' => $total_reject,
            );

            return response([
                'status' => 'OK',
                'record' => $tab,
            ], 200);

        }catch(Exception $th) {
            return response($th->getMessage(), 201);
        }
    }

    /**
     * Fonctoin qui retourne les statistique des agent en un intervalle de temps.
     */
    public function get_statAgentBetween (String $from="", String $to="") {
        try{
            $to_date = $to != "" ? $to : now();
            $from_date = $from != "" ? $from : strtotime($to. ' + 1 days');

            $agents = User::where('role', 1)/*->whereBetween('created_at', [$from_date, $to_date])*/->get();

            $total_delete = $agents->filter(function($item){
                if($item->deleted == 1){
                    return $item;
                }
            })->count();

            $total_active =  $agents->filter(function($item){
                if($item->register_token == null && $item->deleted == 0){
                    return $item;
                }
            })->count();

            $total_non_active =  $agents->filter(function($item){
                if($item->register_token != null && $item->deleted == 0){
                    return $item;
                }
            })->count();

            $tab = Array(
                'delete_users' => $total_delete,
                'active_users' => $total_active,
                'non_active_users' => $total_non_active,
            );

            return response([
                'status' => 'OK',
                'record' => $tab,
            ], 200);

        }catch(Exception $th) {
            return response($th->getMessage(), 201);
        }
    }

    /**
     * Fonction qui permet de supprimer un agent.
     */
    public function deleteAgent(int $agent_id) {

        $agent  = User::find($agent_id);
        $agent->deleted = 1;
        $agent->update();

        // HISTORY.
        $history = new History;
        $history->title = 'Suppression d\'un  agent';
        $history->content = 'L\'agent ' . $agent->personne->nom . ' ' . $agent->personne->prenom .' à été supprimé ';
        $history->action_type = 2;
        $history->user_id = Auth::id();
        $history->save();

        return redirect('/'.strtolower(Auth::user()->role).'/agents')->with('success', 'L\'agent à été supprimé avec succès.');

    }

}
