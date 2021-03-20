<?php

namespace App\Http\Controllers;

use App\Events\AdminEvent;
use App\Events\NotifyEvent;
use App\Models\Assigne;
use App\Models\Categorie;
use App\Models\Courier;
use App\Models\CourierValide;
use App\Models\History;
use App\Models\Personne;
use App\Models\Reject;
use App\Models\ToModify;
use App\Models\User;
use App\Models\Utils;
use DateInterval;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;

class CourrierController extends Controller
{

    public function show ($courier_id) {
        $user = Auth::user();
        $courier = Courier::find($courier_id);
        $current_account = strtolower($user->role);
        $current_action = 'none';
        $title = 'Detail de courier';
        $courier_user = $courier->user;
        $categories = Categorie::all();
        $prestataires = Utils::$PRESTATAIRES;
        $assignments = $courier->assignes()->orderBy('position')->get();
        return view('pages.courier-details', compact('courier_user', 'assignments', 'courier', 'prestataires', 'categories', 'title', 'current_account', 'current_action'));
    }

    public function store (Request $request) {

        // Validations
        $validation = Validator::make($request->all(), array_merge(Courier::$rules, Personne::$rules));
        if($validation->fails()){
            return back()
                ->withInput($request->all())
                ->withErrors($validation->errors());
        }

        // Check if this courier code don't exist.
        if(Courier::chekcIfCodeExist($request->code)){
            return back()
                ->withErrors(['code' => 'Le code du courrier est déjà utilisé, veuillez indiquer un autre code.'])
                ->withInput($request->all());
        }

        try {
            $personne_id = $this->savePersonne($request);
            $id = $this->saveCourier($request, $personne_id);

            $history = new History;
            $history->title = 'Initialisatin d\'un nouveau courrier';
            $history->content = 'Le courrier de code <strong>' . $request->code .'</strong> à été initialisé.';
            $history->action_type = 1;
            $history->user_id = Auth::id();
            $history->save();

            $user = Auth::user();

            // Send the notification to the administrator.
            $event = new AdminEvent([
                'title' => 'Nouveau courrier initialisé', // Title of the notification.
                'content' => 'Le courrier de code <strong>' . $request->code .'</strong> à été initialisé.', // Contne to the notification.
                'receiver_id' => $id,// Id of the receiver.
                'receiver_role' => 'admin/root',// Id of the receiver.
                'user_id' => Auth::id(),
                'user_profile' => $user->profile,
                'courrier_id' => $id,
                'courrier_action' => Utils::$COURRIER_STATE['init'],
                'user_name' => $user->personne->nom,
                'user_surname' => $user->personne->prenom,
            ]);
            event($event);

            return back()
                ->withInput($request->all())
                ->with('success', 'Courier ajouter avec succèss');
        } catch (Exception $e) {
            return back()
                ->withInput($request->all())
                ->withErrors([$e->getMessage()]);
        }
    }

    /**
     * Function to save the personne.
     */
    private function savePersonne(Request $request) {
        $personne = new Personne();
        $personne->nom = $request->nom;
        $personne->prenom = $request->prenom;
        $personne->sexe = $request->sexe;
        $personne->email = $request->email;
        $personne->telephone = $request->telephone;
        $personne->cni = $request->cni;
        $personne->localisation = $request->localisation;
        $personne->status = $request->status;

        $current = Personne::where($personne->toArray())->first();
        if($current != null)
            return $current->id;

        return DB::table('personnes')->insertGetId($personne->toArray());
    }

    /**
     * Function to save the courier.
     */
    private function saveCourier(Request $request, int $personne_id) {
        $courier = new Courier();
        $courier->code = strtoupper($request->code);
        $courier->user_id = Auth::user()->id;
        $courier->categorie_id = $request->categorie_id;
        $courier->personne_id = $personne_id;
        $courier->objet = $request->objet;
        $courier->prestataire = $request->prestataire;
        $courier->tache = $request->tache;
        $courier->recommandation = $request->recommandation;
        $courier->observation = $request->observation;
        $courier->nbPiece = $request->nbPiece;
        $courier->etat = 1;
        $courier->recieved = 0;
        return DB::table('couriers')->insertGetId($courier->toArray());
    }
    
    /**
     * Function that update the Courier.
     */
    public function update (Request $request, int $id) {

        $courier = Courier::find($id);

        $validation = Validator::make($request->all(), array_merge(Courier::$rules, Personne::$rules));
        if($validation->fails()){
            return back()
                ->withInput($request->all())
                ->withErrors($validation->errors());
        }

        // Update Personne Elements.
        $personne = $courier->personne;
        $personne->nom = $request->nom;
        $personne->prenom = $request->prenom;
        $personne->sexe = $request->sexe;
        $personne->email = $request->email;
        $personne->telephone = $request->telephone;
        $personne->cni = $request->cni;
        $personne->localisation = $request->localisation;
        $personne->status = $request->status;
        $personne->update();

        // Update Couriers Element.
        $courier->code = strtoupper($request->code);
        $courier->categorie_id = $request->categorie_id;
        $courier->objet = $request->objet;
        $courier->prestataire = $request->prestataire;
        $courier->tache = $request->tache;
        $courier->recommandation = $request->recommandation;
        $courier->observation = $request->observation;
        $courier->nbPiece = $request->nbPiece;

        if($request->modify == 'modify'){
            $courier->recieved = 0;
            $courier->etat = 7;

            $user = Auth::user();

            // Send the notification to the administrator.
            $event = new AdminEvent([
                'title' => 'Modification d\'un courrier', // Title of the notification.
                'content' => 'Le courrier de code <strong>' . $courier->code .'</strong> à été Modifié.', // Contne to the notification.
                'receiver_id' => null,// Id of the receiver.
                'receiver_role' => 'admin/root',// Id of the receiver.
                'user_id' => Auth::id(),
                'user_profile' => $user->profile,
                'courrier_id' => $id,
                'courrier_action' => Utils::$COURRIER_STATE['modify'],
                'user_name' => $user->personne->nom,
                'user_surname' => $user->personne->prenom,
            ]);
            event($event);
        }

        $courier->update();

        // HISTORY.
        $history = new History;
        $history->title = 'Modification d\'un courrier';
        $history->content = 'Le courrier de code <strong>' . $courier->code .'</strong> à été modifier.';
        $history->action_type = 5;
        $history->user_id = Auth::id();
        $history->save();

        return redirect(URL::previous())
            ->with('success', 'Courier mis à jour avec succèss');
    }
    
    /**
     * Fonction to show courier view of admin.
     */
    public function adminCourrierIndex () {
        $title = strtoupper(Auth::user()->role)  .  'GEST';
        $user = Auth::user();
        $categories = $user->couriers_access_categories;
        $agents = User::where(['role' => 1, 'register_token' => null, 'deleted' => 0])->get();
        $current_account =  'admin';

        if($categories == "all"){
            $couriers_initial = Courier::where('etat', 1)
            ->orderBy('dateEnregistrement')->get();

            $couriers_modifie = Courier::where('etat', 7)
                ->orderBy('updated_at')->get();

            $couriers_traite = Courier::where('etat', 4)
                ->orderBy('updated_at')->get();
        } else {
            $categories = json_decode($categories);
            $couriers_initial = Courier::where('etat', 1)
                ->whereIn('categorie_id', $categories)
                ->orderBy('dateEnregistrement')->get();

            $couriers_modifie = Courier::where('etat', 7)
                ->whereIn('categorie_id', $categories)
                ->orderBy('updated_at')->get();

            $couriers_traite = Courier::where('etat', 4)
                ->whereIn('categorie_id', $categories)
                ->orderBy('updated_at')->get();
        }

        $couriers = Courier::where('etat', 1)->get();
        $current_action = explode('/', Route::current()->uri)[1];
        return view('pages.admin.couriers', compact('user', 'agents', 'couriers_initial', 'couriers_modifie', 'couriers_traite', 'title', 'current_account', 'current_action'));
    
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
            $assign->assignePar = Auth::id();
            $assign->tache = $request->tache;
            $assign->position = $position;
            $assign->terminer = $position == 1 ? 1 : 0;

            if($assign->save()){
                $courier->update(['etat' => 2, 'recieved' => 0]);

                $courier = Courier::find($request->courier_id);

                // HISTORY.
                $agent = User::find($request->agent_id)->personne;
                $history = new History;
                $history->title = 'Courrier assigné';
                $history->content = 'Le courrier de code <strong>' . $courier->code .'</strong> à été assigné à l\'agent ' . $agent->nom . ' ' . $agent->prenom;
                $history->action_type = 1;
                $history->user_id = Auth::id();
                $history->save();

                $user = Auth::user();
                $user_agent = User::find($request->agent_id);

                // Send the notification to the administrator.
                $event = new NotifyEvent([
                    'title' => 'Courrier assigné', // Title of the notification.
                    'content' => 'Le courrier de code <strong>' . $courier->code .'</strong> vous à été assigné.', // Contne to the notification.
                    'receiver_id' => $user_agent->id,// Id of the receiver.
                    'receiver_role' => $user_agent->role,// Id of the receiver.
                    'user_id' => Auth::id(),
                    'user_profile' => $user->profile,
                    'user_name' => $user->personne->nom,
                    'user_surname' => $user->personne->prenom,
                    'courrier_tache' => $assign->tache,
                    'courrier_id' => $courier->id,
                    'courrier_action' => Utils::$COURRIER_STATE['finish'],
                ]);
                event($event);

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

    /**
     * Fonction qui ajout nouvelle etat de modification.
     */
    public function add_to_modify($id, $reason) {
        try{
            $courier = Courier::find($id);

            if($courier->etat != 'Initial' && $courier->etat != 'Modifié'){
                return response('Le dossier n\'est plus modifiable.', 201);
            }
            $toModify = new ToModify;
            $toModify->courier_id = $id;
            $toModify->reason = $reason;
            $toModify->user_id = Auth::id();
            $toModify->save();

            // HISTORY.
            $history = new History;
            $history->title = 'Renvoie d\'un courrier';
            $history->content = 'Le courrier de code <strong>' . $courier->code .'</strong> à été renvoyé pour une modification au service d\'accueil.';
            $history->action_type = 3;
            $history->user_id = Auth::id();
            $history->save();

            $user = Auth::user();

            // Send the notification to the administrator.
            $event = new NotifyEvent([
                'title' => 'Renvoie d\'un courrier', // Title of the notification.
                'content' => 'Le courrier de code <strong>' . $courier->code .'</strong> vous à été renvoyé pour une modification.', // Contne to the notification.
                'receiver_id' => $courier->user->id,// Id of the receiver.
                'receiver_role' => $courier->user->role,// Id of the receiver.
                'user_id' => Auth::id(),
                'user_profile' => $user->profile,
                'user_name' => $user->personne->nom,
                'user_surname' => $user->personne->prenom,
                'courrier_id' => $id,
                'courrier_action' => Utils::$COURRIER_STATE['modify'],
            ]);
            event($event);

            $courier->etat = 8; // set to  modify state.
            $courier->recieved = 0;
            $courier->update();

            return response('', 200);
        }catch(Exception $th){
            return response($th->getMessage(), 201);
        }
    }

    /**
     * Fonction qui ajout un nouvelle etat de rejet.
     */
    public function add_to_reject($id, $reason) {
        try{
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
            $history->content = 'Le courrier de code <strong>' . $courier->code .'</strong> à été rejeté.';
            $history->action_type = 3;
            $history->user_id = Auth::id();
            $history->save();

            $courier->etat = 6;
            $courier->recieved = 0;
            $courier->update(); // Mettre à l'état de modification.

            $user = Auth::user();

            // Send the notification to the administrator.
            $event = new NotifyEvent([
                'title' => 'Courrier rejeté', // Title of the notification.
                'content' => 'Le courrier de code <strong>' . $courier->code .'</strong> a été rejeté.', // Contne to the notification.
                'receiver_id' => $courier->user->id,// Id of the receiver.
                'receiver_role' => $courier->user->role,// Id of the receiver.
                'courrier_id' => $courier->id,
                'courrier_action' => Utils::$COURRIER_STATE['reject'],
                'user_id' => Auth::id(),
                'user_profile' => $user->profile,
                'user_name' => $user->personne->nom,
                'user_surname' => $user->personne->prenom,
            ]);
            event($event);

            return response('', 200);
        }catch(Exception $th){
            return response($th->getMessage(), 201);
        }
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

            $courier->recieved = 0;
            $courier->update();

            // HISTORY.
            $history = new History;
            $history->title = 'Validation d\'un courrier';
            $history->content = 'Le courrier de code <strong>' . $courier->code .'</strong> à été validé.';
            $history->action_type = 4;
            $history->user_id = Auth::id();
            $history->save();

            $user = Auth::user();

            // Send the notification to the administrator.
            $event = new NotifyEvent([
                'title' => 'Courrier validé', // Title of the notification.
                'content' => 'Le courrier de code <strong>' . $courier->code .'</strong> à été validé.', // Contne to the notification.
                'receiver_id' => $courier->user->id,// Id of the receiver.
                'receiver_role' => $courier->user->role,// Id of the receiver.
                'courrier_id' => $courier->id,
                'courrier_action' => Utils::$COURRIER_STATE['validate'],
                'user_id' => Auth::id(),
                'user_profile' => $user->profile,
                'user_name' => $user->personne->nom,
                'user_surname' => $user->personne->prenom,
            ]);
            event($event);

            return response('', 200);
        }catch(Exception $e){
            return response($e, 201);
        }
    }

    /**
     * Function to make courier as recieved.
     */
    public function marckAsRecieved (int $id) {
        $courrier = Courier::find($id);
        $courrier->recieved = 1;
        $courrier->update();
        return back()->with('success', 'Courrier marqué comme courrier reçut.');
    }

    /**
     * Function to make courier as not recieved.
     */
    public function marckAsNotRecieved(int $id) {
        $courrier = Courier::find($id);
        $courrier->recieved = 0;
        $courrier->update();
        return back()->with('success', 'Courrier marqué comme courrier non reçut.');
    }

    /**
     * Function to get all courier init after 1 second.
     */
    public function handleNewCourrierInit() {

        try {
            $date_to = now();
            $date_from = now();
            $date_from->sub(new DateInterval('PT1S'));

            // Le courrier terminé par une seconde.
            $courrier = Courier::where('etat', 1)
                ->whereBetween('updated_at', [$date_from, $date_to])
                ->first();

            $record = null;

            if($courrier != null) {
                $date = Utils::full_date_format($courrier->dateEnregistrement);
                $record = [
                    'id' => $courrier->id,
                    'nom' => $courrier->personne->nom,
                    'prenom' => $courrier->personne->prenom,
                    'telephone' => $courrier->personne->telephone,
                    'objet' => $courrier->objet,
                    'nbPiece' => $courrier->nbPiece,
                    'etat' => $courrier->etat,
                    'prestataire' => $courrier->prestataire,
                    'date' => $date,
                    'categorie' => $courrier->categorie->intitule,
                ];

            }
            $result = [
                'status' => 'OK',
                'record' => $courrier == null ? null : $record,
            ];
            return response ($result, 200);
        } catch (Exception $e) {
            return response ($e->getMessage(), 201);
        }
    }

    /**
     * Function to set the observation to courier.
     */
    public function setObservation(Request $request) {
        try{
            $courier = Courier::find($request->courier_id);
            $courier->observation = $request->observation;

            $history = new History;
            $history->title = 'Modification de courrier';
            $history->content = 'Observation faite sur le courrier dont le code est <strong>' . $courier->code .'</strong>';
            $history->action_type = 5;
            $history->user_id = Auth::id();

            if($courier->update() && $history->save()){
                return response('', 200);
            }else{
                return response('Une erreur s\'est produite, veuillez réessayer de nouveau.', 201);
            }
            
        }catch(Exception $e) {
            return response($e->getMessage(), 201);
        }
    }
}
