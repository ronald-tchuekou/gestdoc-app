<?php

namespace App\Http\Controllers;

use App\Mail\RegisterMail;
use App\Models\Assigne;
use App\Models\Courier;
use App\Models\Personne;
use App\Models\Reject;
use App\Models\Service;
use App\Models\ToModify;
use App\Models\User;
use App\Utils\Utils;
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
        $current_action = explode('/', Route::current()->uri)[1];
        return view('pages.admin.index', compact('title', 'current_account', 'current_action'));
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
        $current_action = explode('/', Route::current()->uri)[1];
        return view('pages.admin.parametres', compact('title', 'current_account', 'current_action'));
    }

    public function showAgentsView() {
        $title = 'MARIE GEST';
        $current_account =  'admin';
        $agents = User::where('role', 1)->get();
        $services = Service::all();
        $current_action = explode('/', Route::current()->uri)[1];
        return view('pages.admin.agents', compact('services', 'agents', 'title', 'current_account', 'current_action'));
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
        return view('pages.admin.couriers', compact('agents', 'couriers_initial', 'couriers_modifie', 'couriers_traite', 'title', 'current_account', 'current_action'));
    }

    public function showAddAgentView() {
        $title = 'MARIE GEST';
        $current_account =  'admin';
        $agent_mode = 'add';
        $services = Service::all();
        $current_action = explode('/', Route::current()->uri)[1];
        return view('pages.admin.agents', compact('services', 'agent_mode', 'title', 'current_account', 'current_action'));
    }

    public function showEditAgentView() {
        $title = 'MARIE GEST';
        $current_account =  'admin';
        $agent_mode = 'edit';
        $current_action = explode('/', Route::current()->uri)[1];
        return view('pages.admin.agents', compact('agent_mode', 'title', 'current_account', 'current_action'));
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
        $user->register_token = str_replace('/', '', bcrypt($this->str_random(20)));
        $user->save();

        Mail::to($personne->email, $personne->nom . ' ' . $personne->prenom)
            ->send(new RegisterMail($user));

        return redirect('/admin/agents/add')
            ->withInput($request->all())
            ->with('success', 'Agent ajouté avec succèss');
    }

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
        
        $courier->etat = 8; // set to  modify state.
        $courier->update();

        return response('', 200);
    }
    
    /**
     * Fonction qui ajout un nouvelle etat de rejet.
     */
    public function add_to_reject($id, $reason) {
        $courier = Courier::find($id);

        if($courier->etat != 'Rejeté'){
            return response('Le dossier à déjà été rejeté.', 201);
        }
        $reject = new Reject;
        $reject->courier_id = $id;
        $reject->reason = $reason;
        $reject->save();
        
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
            $courier->update();

            return response('', 200);
        }catch(Exception $e){
            return response($e, 201);
        }
    }

}
