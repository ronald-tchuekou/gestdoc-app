<?php

namespace App\Http\Controllers;

use App\Models\Assigne;
use App\Models\Categorie;
use App\Models\Courier;
use App\Models\Personne;
use App\Models\Service;
use App\Models\Utils\Utils;
use Exception;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;

class AgentController extends Controller
{

    protected $redirectTo = '/agent/couriers';

    protected $finish_couriers;

    public function index () {
        $user = Auth::user();
        $title = 'AGENT GEST';
        $current_account =  'agent';
        $current_action = explode('/', Route::current()->uri)[1];

        // Les couriers validés.
        $valide_couriers = $user->couriers_initialises()->where('etat', 5);

        // Les couriers rejetés.
        $reject_couriers = $user->couriers_initialises()->where('etat', 6)->get();

        // Les couriers à modifier.
        $modify_couriers = $user->couriers_initialises()->where('etat', 8)->get();

        // Les couriers à traiter.
        $f_couriers1 = $user->couriers_assignes()->where('etat', 2)->get();
        $f_couriers = $f_couriers1->concat($user->couriers_assignes()->where('etat', 3)->get());

        $this->finish_couriers = [];
        $f_couriers->each(function($item, $key) {
            $terminer = $item->assignes()->where('user_id', Auth::user()->id)->first();
            if($terminer->terminer == 1 && $item != null){
                array_push($this->finish_couriers, $item);
            }
        });

        $finish_couriers = $this->finish_couriers;

        return view('pages.agent.index', compact('valide_couriers', 'reject_couriers', 'modify_couriers', 'finish_couriers', 'title', 'current_account', 'current_action'));
    }

    public function showProfileView () {
        $title = 'AGENT GEST';
        $current_account =  'agent';
        $current_action = explode('/', Route::current()->uri)[1];
        return view('pages.agent.profile', compact('title', 'current_account', 'current_action'));
    }

    public function showParametresView() {
        $title = 'AGENT GEST';
        $current_account =  'agent';
        $current_action = explode('/', Route::current()->uri)[1];
        return view('pages.agent.parametres', compact('title', 'current_account', 'current_action'));
    }
    
    public function showCouriersView() {
        $title = 'AGENT GEST';
        $user = Auth::user();
        $current_account =  'agent';
        $current_action = explode('/', Route::current()->uri)[1];
        $couriers = $user->couriers_initialises()->where('etat', 1)->get();
        return view('pages.agent.couriers', compact('couriers', 'title', 'current_account', 'current_action'));
    }
    
    public function showAddCouriersView() {
        $title = 'AGENT GEST';
        $current_account =  'agent';
        $current_action = explode('/', Route::current()->uri)[1];
        $courier_mode = 'add';
        // DATAS;
        $categories = Categorie::all();
        $prestataires = Utils::$PRESTATAIRES; // TODO
        $services = Service::all();
        return view('pages.agent.couriers', compact('services', 'prestataires', 'categories', 'courier_mode', 'title', 'current_account', 'current_action'));
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
        
        $personne_id = $this->savePersonne($request);
        $this->saveCourier($request, $personne_id);

        return redirect($this->redirectTo . '/add')
            ->withInput($request->all())
            ->with('success', 'Courier ajouter avec succèss');
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
        $courier->service_id = Auth::user()->service_id;
        $courier->objet = $request->objet;
        $courier->prestataire = $request->prestataire;
        $courier->tache = $request->tache;
        $courier->recommandation = $request->recommandation;
        $courier->observation = $request->observation;
        $courier->nbPiece = $request->nbPiece;
        
        if(isset($request->modify) && $request->modify == 'modify'){
            $courier->etat = 7;
        }

        $courier->update();

        return redirect('/agent/couriers')
            ->withInput($request->all())
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
        $courier->service_id = Auth::user()->service_id;
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
            
            // TODO Notify the administrator if the traitement is finish.
    
            return response('', 200);
        }catch(Exception $e){
            return response($e, 201);
        }

    }

    public function editCourierShowView ($id) {
        $title = 'AGENT GEST';
        $current_account =  'agent';
        $current_action = explode('/', Route::current()->uri)[1];
        $courier_mode = 'edit';
        // DATAS;
        $categories = Categorie::all();
        $prestataires = ['MINCOM', 'SSCO']; // TODO
        $services = Service::all();
        $courier = Courier::find($id);
        if($courier == null)
            return response(null, 400);
        return view('pages.agent.couriers', compact('courier', 'services', 'prestataires', 'categories', 'courier_mode', 'title', 'current_account', 'current_action'));
    }

    /**
     * Function to show thet view details of courier.
     */
    public function showCourier (int $id) {
        $courier = Courier::find($id);
        dd($courier);
    }
}
