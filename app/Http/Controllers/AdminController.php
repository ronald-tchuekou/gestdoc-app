<?php

namespace App\Http\Controllers;

use App\Mail\RegisterMail;
use App\Models\Assigne;
use App\Models\Courier;
use App\Models\CourierValide;
use App\Models\History;
use App\Models\Personne;
use App\Models\Reject;
use App\Models\Service;
use App\Models\ToModify;
use App\Models\User;
use App\Models\Utils;
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
        $title = 'MARIE GEST';
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
        $title = 'MARIE GEST';
        $current_account =  'admin';
        $user = Auth::user();
        $current_action = explode('/', Route::current()->uri)[1];
        return view('pages.admin.profile', compact('user', 'title', 'current_account', 'current_action'));
    }

    public function showParametresView() {
        $title = 'MARIE GEST';
        $current_account =  'admin';
        $user = Auth::user();
        $current_action = explode('/', Route::current()->uri)[1];
        return view('pages.admin.parametres', compact('user', 'title', 'current_account', 'current_action'));
    }

    public function showAgentsView() {
        $title = 'MARIE GEST';
        $current_account =  'admin';
        $agents = User::where('role', 1)->get();
        $services = Service::all();
        $user = Auth::user();
        $current_action = explode('/', Route::current()->uri)[1];
        return view('pages.admin.agents', compact('user', 'services', 'agents', 'title', 'current_account', 'current_action'));
    }

    public function showCouriersView() {
        $title = 'MARIE GEST';
        $user = Auth::user();
        $agents = User::where(['role' => 1, 'register_token' => null])->get();
        $current_account =  'admin';

        $couriers_initial = Courier::where('etat', 1)
            ->orderBy('dateEnregistrement')->get();

        $couriers_modifie = Courier::where('etat', 7)
            ->orderBy('updated_at')->get();

        $couriers_traite = Courier::where('etat', 4)
            ->orderBy('updated_at')->get();

        $couriers = Courier::where('etat', 1)->get();
        $current_action = explode('/', Route::current()->uri)[1];
        return view('pages.admin.couriers', compact('user', 'agents', 'couriers_initial', 'couriers_modifie', 'couriers_traite', 'title', 'current_account', 'current_action'));
    }

    public function showAddAgentView() {
        $title = 'MARIE GEST';
        $current_account =  'admin';
        $agent_mode = 'add';
        $user = Auth::user();
        $services = Service::all();
        $current_action = explode('/', Route::current()->uri)[1];
        return view('pages.admin.agents', compact('user', 'services', 'agent_mode', 'title', 'current_account', 'current_action'));
    }

    public function showEditAgentView() {
        $title = 'MARIE GEST';
        $current_account =  'admin';
        $agent_mode = 'edit';
        $user = Auth::user();
        $current_action = explode('/', Route::current()->uri)[1];
        return view('pages.admin.agents', compact('user', 'agent_mode', 'title', 'current_account', 'current_action'));
    }

    /**
     * Function that assign courier work to a service.
     */
    public function assignCourier(Request $request) {
        
        $courier = Courier::find($request->courier_id);

        // Assignation.
        $findExist = Assigne::where(['user_id' => $request->agent_id, 'courier_id' => $request->courier_id])->first();
        if($findExist != null){
            return response('Cette agent est déjà assigné à ce dossier.', 201);
        }

        // Check if this element don't exist.
        $assigne = Assigne::where('courier_id', $request->courier_id)
            ->where('user_id', $request->agent_id)->first();

        if($assigne != null) {
            return response('Cette personne est déjà assigné à ce courier', 201);
        }

        try{ // Capture des erreurs produites.

            $position = $this->getLastPosition($request->courier_id) + 1;
            $assign = new Assigne;
            $assign->courier_id = $request->courier_id;
            $assign->user_id = $request->agent_id;
            $assign->assignePar = Auth::user()->id;
            $assign->tache = $request->tache;
            $assign->position = $position;
            $assign->terminer = $position == 1 ? 1 : 0;

            if($assign->save()){
                $courier->update(['etat' => 2]);

                // HISTORY.
                $agent = User::find($request->agent_id)->personne;
                $history = new History;
                $history->title = 'Courrier assigné';
                $history->content = 'Le courrier N° '. $request->courier_id .' à été assigné à l\'agent ' . $agent->nom . ' ' . $agent->prenom;
                $history->action_type = 1;
                $history->user_id = Auth::id();
                $history->save(); 

                return response('', 200);
            }

            return response('Assignation échouée.', 201);
        }catch(Exception $e){
            return response($e, 200);
        }
    }

    /**
     * fonction qui retourne la dernière position d'assignation de l'user sur un courier.
     */
    public function getLastPosition (int $courier_id) {
        $assign = Assigne::where('courier_id', $courier_id)
            ->where('assignePar', Auth::user()->id)
            ->orderBy('position', 'DESC')->first();
        if($assign == null)
            return 0;
        else
            return $assign->position;
    }

    public function storeAgent(Request $request) {

        $validation = Validator::make($request->all(), array_merge(Personne::$rules), ['service_id' => 'required']);
        
        if($validation->fails()){
            return redirect('/admin/agents/add')
                ->withInput($request->all())
                ->withErrors($validation->errors());
        }

        if(Personne::where('nom', $request->nom)->where('prenom', $request->prenom)->count() != 0){
            return redirect('/admin/agents/add')
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

        return redirect('/admin/agents/add')
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
     * Fonction qui ajout nouvelle etat de modification.
     */
    public function add_to_modify($id, $reason) {
        $courier = Courier::find($id);

        if($courier->etat != 'Initial' && $courier->etat != 'Modifié'){
            return response('Le dossier n\'est plus modifiable.', 201);
        }
        $toModify = new ToModify;
        $toModify->courier_id = $id;
        $toModify->reason = $reason;
        $toModify->save();

        // HISTORY.
        $history = new History;
        $history->title = 'Renvoie d\'un courrier';
        $history->content = 'Le courrier N° ' . $id .' à été renvoyé pour une modification au service d\'accueil.';
        $history->action_type = 3;
        $history->user_id = Auth::id();
        $history->save(); 
        
        $courier->etat = 8; // set to  modify state.
        $courier->update();

        return response('', 200);
    }
    
    /**
     * Fonction qui ajout un nouvelle etat de rejet.
     */
    public function add_to_reject($id, $reason) {
        $courier = Courier::find($id);

        if($courier->etat == 'Rejeté'){
            return response('Le dossier à déjà été rejeté.', 201);
        }
        $reject = new Reject;
        $reject->courier_id = $id;
        $reject->reason = $reason;
        $reject->user_id = Auth::id();
        $reject->save();

        // HISTORY.
        $history = new History;
        $history->title = 'Rejet d\'un courrier';
        $history->content = 'Le courrier N° ' . $id .' à été rejeté.';
        $history->action_type = 3;
        $history->user_id = Auth::id();
        $history->save(); 
        
        $courier->etat = 6;
        $courier->update(); // Mettre à l'état de modification.

        return response('', 200);
    }

    /**
     * Fonction qui permet de valider un courier.
     */
    public function validate_courier ($id) {
        try{
            $courier = Courier::find($id);
            $courier->etat = 5; // Etat de validation du courier.

            $validate = new CourierValide;
            $validate->courier_id = $id;
            $validate->user_id = Auth::user()->id;
            
            if(!$validate->save()){
                return response('Erreur de validation, veuillez reprendre.', 201);
            }

            $courier->update();

            // HISTORY.
            $history = new History;
            $history->title = 'Validation d\'un courrier';
            $history->content = 'Le courrier N° ' . $id .' à été validé.';
            $history->action_type = 4;
            $history->user_id = Auth::id();
            $history->save(); 

            return response('', 200);
        }catch(Exception $e){
            return response($e, 201);
        }
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

            $agents = User::where('role', 1)->whereBetween('created_at', [$from_date, $to_date])->get();
            $total = $agents->count();
            $total_active =  $agents->filter(function($item){
                if($item->register_token == null){
                    return $item;
                }
            })->count();
            $total_non_active =  $agents->filter(function($item){
                if($item->register_token != null){
                    return $item;
                }
            })->count();

            $tab = Array(
                'total' => $total,
                'active' => $total_active,
                'non_active' => $total_non_active,
            );

            return response([
                'status' => 'OK',
                'record' => $tab,
            ], 200);

        }catch(Exception $th) {
            return response($th->getMessage(), 201);
        }
    }
}
