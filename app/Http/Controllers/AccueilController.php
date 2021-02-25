<?php

namespace App\Http\Controllers;

use App\Models\Assigne;
use App\Models\Categorie;
use App\Models\Courier;
use App\Models\History;
use App\Models\Personne;
use App\Models\Service;
use App\Models\User;
use App\Models\Utils;
use DateInterval;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;

class AccueilController extends Controller
{

    protected $redirectTo = '/accueil/couriers';

    protected $finish_couriers;

    public function index () {
        $user = Auth::user();
        $title = 'ACCUEIL GEST';
        $current_account =  'accueil';
        $current_action = explode('/', Route::current()->uri)[1];

        // Les couriers validés.
        $valide_couriers = $user->couriers_initialises()->where('etat', 5)->orderBy('updated_at', 'DESC')->get();

        // Les couriers rejetés.
        $reject_couriers = $user->couriers_initialises()->where('etat', 6)->orderBy('updated_at', 'DESC')->get();

        // Les couriers à modifier.
        $modify_couriers = $user->couriers_initialises()->where('etat', 8)->orderBy('updated_at', 'DESC')->get();

        return view('pages.accueil.index', compact('valide_couriers', 'reject_couriers', 'modify_couriers', 'title', 'current_account', 'current_action'));
    }
    
    public function showProfileView () {
        $title = 'ACCUEIL GEST';
        $current_account = 'accueil';
        $current_action = explode('/', Route::current()->uri)[1];
        return view('pages.agent.profile', compact('title', 'current_account', 'current_action'));
    }

    public function showParametresView() {
        $title = 'ACCUEIL GEST';
        $current_account = 'accueil';
        $current_action = explode('/', Route::current()->uri)[1];
        return view('pages.agent.parametres', compact('title', 'current_account', 'current_action'));
    }
    
    public function showCouriersView() {
        $title = 'ACCUEIL GEST';
        $user = Auth::user();
        $current_account = 'accueil';
        $current_action = explode('/', Route::current()->uri)[1];
        $couriers = $user->couriers_initialises()->where('etat', 1)->get();
        return view('pages.accueil.couriers', compact('couriers', 'title', 'current_account', 'current_action'));
    }
    
    public function showAddCouriersView() {
        $title = 'ACCUEIL GEST';
        $current_account = 'accueil';
        $current_action = explode('/', Route::current()->uri)[1];
        $courier_mode = 'add';
        // DATAS;
        $categories = Categorie::all();
        $prestataires = Utils::$PRESTATAIRES; // TODO
        $services = Service::all();
        return view('pages.accueil.couriers', compact('services', 'prestataires', 'categories', 'courier_mode', 'title', 'current_account', 'current_action'));
    }

    /**
     * Function that store the new Courier.
     */
    public function storeCourier (Request $request) {
        
        // Validations
        $validation = Validator::make($request->all(), array_merge(Courier::$rules, Personne::$rules));
        if($validation->fails()){
            return redirect($this->redirectTo . '/add')
                ->withInput($request->all())
                ->withErrors($validation->errors());
        }
        
        try {
            $personne_id = $this->savePersonne($request);
            $id = $this->saveCourier($request, $personne_id);

            $history = new History;
            $history->title = 'Initialisatin d\'un nouveau courrier';
            $history->content = 'Le courrier N° ' . $id .' à été initialisé.';
            $history->action_type = 1;
            $history->user_id = Auth::id();
            $history->save();

            return redirect($this->redirectTo . '/add')
                ->withInput($request->all())
                ->with('success', 'Courier ajouter avec succèss');
        } catch (Exception $e) {
            return redirect($this->redirectTo . '/add')
                ->withInput($request->all())
                ->withErrors([$e->getMessage()]);   
        }
    }

    /**
     * Function that update the Courier.
     */
    public function updateCourier (Request $request, int $id) {

        $courier = Courier::find($id);

        $validation = Validator::make($request->all(), array_merge(Courier::$rules, Personne::$rules));
        if($validation->fails()){
            return redirect('/agent/couriers/update/' . $id)
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
        $courier->categorie_id = $request->categorie_id;
        $courier->objet = $request->objet;
        $courier->prestataire = $request->prestataire;
        $courier->tache = $request->tache;
        $courier->recommandation = $request->recommandation;
        $courier->observation = $request->observation;
        $courier->nbPiece = $request->nbPiece;
        
        $courier->etat = 7;

        $courier->update();

        // HISTORY.
        $history = new History;
        $history->title = 'Modification d\'un courrier';
        $history->content = 'Le courrier N° ' . $id .' à été modifier.';
        $history->action_type = 5;
        $history->user_id = Auth::id();
        $history->save();

        return redirect()->back()
            ->with('success', 'Courier mis à jour avec succèss');
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
        return DB::table('couriers')->insertGetId($courier->toArray());
    }

    /**
     * Function to edit the selected courier.
     */
    public function editCourier (int $id) {
        $courier_obj = Courier::find($id);
        $personne_obj = $courier_obj->personne;
        
        $courier = $courier_obj->toArray();
        $element = $personne_obj->toArray();
        array_shift($element);
        $personne = $element;
        $data = array_merge($courier, $personne);

        return redirect($this->redirectTo . '/' . $id . '/edit')
            ->withInput($data);
    }

    /**
     * Function to set the modify view of courier.
     */
    public function modifyCourier(int $id){
        $courier_obj = Courier::find($id);
        $personne_obj = $courier_obj->personne;
        
        $courier = $courier_obj->toArray();
        $element = $personne_obj->toArray();
        array_shift($element);
        $personne = $element;
        $data = array_merge($courier, $personne, ['modify' => 'modify']);

        return redirect($this->redirectTo . '/' . $id . '/edit')
            ->withInput($data);
    }

    /**
     * Function to finish a work.
     */
    public function finishCourier (int $id) {
        try{

            $courier = Courier::find($id);
            $user = Auth::user();
    
            $assigne = $courier->assignes()->where('user_id', $user->id)->first();
            $assigne->terminer = 2;
            $assigne->update();
    
            $completAssign = $courier->assignes()->where('terminer', 2)->count();
            $totalAssign = $courier->assignes()->count();
            
            if($completAssign == $totalAssign){
                $courier->etat = 4;
            } else {
                $courier->etat = 3;
                $nextAssign = Assigne::where(['courier_id' => $id, 'position' => $assigne->position + 1])->first();
                $nextAssign->terminer = 1;
                $nextAssign->update();
            }
            
            $courier->update();

            // HISTORY.
            $history = new History();
            $agent = $assigne->agent->personne;
            $history->title = 'Traitement d\'un courrier';
            $history->content = 'Le courrier N° ' . $id .' à été Traité par '. $agent->nom . ' ' . $agent->prenom;
            $history->action_type = 6;
            $history->user_id = Auth::id();
            $history->save();
            
            // TODO Notify the administrator if the traitement is finish.
    
            return response('', 200);
        }catch(Exception $e){
            return response($e, 201);
        }

    }

    public function editCourierShowView ($id) {
        $title = 'ACCUEIL GEST';
        $current_account = 'accueil';
        $current_action = explode('/', Route::current()->uri)[1];
        $courier_mode = 'edit';
        // DATAS;
        $categories = Categorie::all();
        $prestataires = ['MINCOM', 'SSCO']; // TODO
        $services = Service::all();
        $courier = Courier::find($id);
        if($courier == null)
            return response(null, 400);
        return view('pages.accueil.couriers', compact('courier', 'services', 'prestataires', 'categories', 'courier_mode', 'title', 'current_account', 'current_action'));
    }

    /**
     * Function to show thet view details of courier.
     */
    public function showCourier (int $id) {
        $courier = Courier::find($id);
        dd($courier);
    }

    public function handleChange (int $id) {
        try{
            $date_to = now();
            $date_from = now();
            $date_from->sub(new DateInterval('PT1S'));

            $user = User::find($id);

            // Les couriers validés.
            $valide_couriers = $user->couriers_initialises()->where('etat', 5)
              ->whereBetween('updated_at', [$date_from, $date_to])
                ->first();

            // Les couriers rejetés.
            $reject_couriers = $user->couriers_initialises()->where('etat', 6)
              ->whereBetween('updated_at', [$date_from, $date_to])
                ->first();

            // Les couriers à modifier.
            $modify_couriers = $user->couriers_initialises()->where('etat', 8)
              ->whereBetween('updated_at', [$date_from, $date_to])
                ->first();

            $courrier = $valide_couriers != null ? $valide_couriers : 
                ($reject_couriers != null ? $reject_couriers : 
                    ($modify_couriers != null ? $modify_couriers : null));
                    
            if($courrier != null){

                $date = Utils::full_date_format($courrier->updated_at);

                $result = Array(
                    'id' => $courrier->id,
                    'etat' => $courrier->etat,
                    'motif' => $this->getMotif($courrier),
                    'objet' => $courrier->objet,
                    'date' => $date,
                    'prestataire' => $courrier->prestataire,
                    'name' => $courrier->personne->nom,
                    'surname' => $courrier->personne->prenom,
                    'phone' => $courrier->personne->telephone,
                    'user_profile' => User::where('role', 2)->first()->profile,
                    'action' => $this->getAction($courrier->etat). $courrier->id,
                    'content' =>  'Action faite le ' . $date,
                );

                return response([
                    'status' => 'OK',
                    'record' => $result,
                ], 200);
            }
        }catch(Exception $th) {
            return response($th->getMessage(), 201);
        }
    }

    private function getMotif($courrier) {
        if($courrier->etat == 'Reprendre') {
            return $courrier->to_modify->reason;
        }
        elseif($courrier->etat == 'Rejeté') {
            return $courrier->reject->reason ;
        }
        elseif($courrier->etat == 'Validé') {
            return '' ;
        }
    }

    private function getAction($etat) {
        if($etat == 'Reprendre') {
            return 'Rejet (Modification) Courrier N° ';
        }
        elseif($etat == 'Rejeté') {
            return 'Rejet (Définitif) Courrier N° ' ;
        }
        elseif($etat == 'Validé') {
            return 'Validation du courrier N° ' ;
        }
    }

    public function allInitCourriers ($user_id) {

        try {
            $date_to = now();
            $date_from = now();
            $date_from->sub(new DateInterval('PT10S'));

            $user = User::find($user_id);

            // Le courrier terminé par une seconde.
            $courrier1 = $user->couriers_initialises()->where('etat', 2)
                ->whereBetween('updated_at', [$date_from, $date_to])
                ->first();
            $courrier2 = $user->couriers_initialises()->where('etat', 6)
                ->whereBetween('updated_at', [$date_from, $date_to])
                ->first();
            $courrier3 = $user->couriers_initialises()->where('etat', 8)
                ->whereBetween('updated_at', [$date_from, $date_to])
                ->first();

            $courrier = $courrier1 != null ? $courrier1 : 
                ($courrier2 != null ? $courrier2 : 
                    ($courrier3 != null ? $courrier3 : null));

            $result = [
                'status' => 'OK',
                'context' => $this->getContext($courrier),
                'record' => $courrier == null ? null : $courrier->toArray(),
            ];
            return response ($result, 200);
        } catch (Exception $e) {
            return response ($e->getMessage(), 201);
        }

    }

    /**
     * Fonction qui permet de retourner le context selon, l'etat du courrier.
     */
    private function getContext ($courrier) {
        $etat = $courrier->etat;
        if($etat == 'Reprendre') {
            return 'retourné pour modification';
        }
        if($etat == 'Rejeté'){
            return 'rejeté';
        }
        if($etat == 'Assigné'){
            return 'assigné';
        }
    }
}
