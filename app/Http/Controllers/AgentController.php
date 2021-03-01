<?php

namespace App\Http\Controllers;

use App\Events\AdminEvent;
use App\Models\Assigne;
use App\Models\Courier;
use App\Models\History;
use App\Models\User;
use App\Models\Utils;
use DateInterval;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
        $valide_couriers = $user->couriers_initialises()->where('etat', 5)->orderBy('updated_at', 'DESC')->get();

        // Les couriers rejetés.
        $reject_couriers = $user->couriers_initialises()->where('etat', 6)->orderBy('updated_at', 'DESC')->get();

        // Les couriers à modifier.
        $modify_couriers = $user->couriers_initialises()->where('etat', 8)->orderBy('updated_at', 'DESC')->get();

        // Les couriers à traiter.
        $f_couriers1 = $user->couriers_assignes()->where('etat', 2)->get();
        $f_couriers = $f_couriers1->concat($user->couriers_assignes()->where('etat', 3)->orderBy('updated_at', 'DESC')->get());

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

            // HISTORY
            $history = new History();
            $history->title = 'Traitement d\'un courrier';
            $history->content = 'Le courrier N° ' . $id .' à été Traité.';
            $history->action_type = 6;
            $history->user_id = Auth::id();
            $history->save();

            // Send the notification to the administrator.
            $event = new AdminEvent([
                'title' => 'Traitement d\'un courrier', // Title of the notification.
                'content' => 'Le courrier N° ' . $id .' à été Traité.', // Contne to the notification.
                'receiver_id' => $id,// Id of the receiver.
                'receiver_role' => 'admin/root',// Id of the receiver.
                'user_id' => Auth::id(),
                'user_profile' => $user->profile,
                'courrier_id' => $id,
                'courrier_action' => Utils::$COURRIER_STATE['finish'],
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
     * Function to show thet view details of courier.
     */
    public function showCourier (int $id) {
        $courier = Courier::find($id);
        dd($courier);
    }

    /**
     * Fonction renvoie les information d'un courrier.
     */
    public function getCourrierIfon(int $id){
        try {
            $courrier = Courier::find($id);

            $date = Utils::full_date_format($courrier->dateEnregistrement);
            $update = $courrier->updated_at == null ? null : Utils::full_date_format($courrier->updated_at);

            $record = [
                'id' => $courrier->id,
                'nom' => $courrier->personne->nom,
                'prenom' => $courrier->personne->prenom,
                'telephone' => $courrier->personne->telephone,
                'phone' => $courrier->personne->telephone,
                'name' => $courrier->personne->prenom,
                'surname' => $courrier->personne->telephone,
                'objet' => $courrier->objet,
                'nbPiece' => $courrier->nbPiece,
                'etat' => $courrier->etat,
                'prestataire' => $courrier->prestataire,
                'date' => $date,
                'update' => $update,
                'categorie' => $courrier->categorie->intitule,
                'motif' => $this->getMotif($courrier),
            ];

            $result = [
                'status' => 'OK',
                'record' => $record,
            ];
            return response ($result, 200);

        } catch (Exception $th) {
            return response($th->getMessage(), 201);
        }
    }

    /**
     * Fonction qui permet de récupérer les motif d'un courrier.
     */
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
}
