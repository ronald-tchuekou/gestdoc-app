<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

class LocationController extends Controller
{

    public function index () {

        $title = strtoupper(Auth::user()->role)  .  'GEST';
        $current_account =  'admin';
        $agent_mode = 'add';
        $user = Auth::user();
        $locations = Location::all();
        $current_action = explode('/', Route::current()->uri)[1];
        return view('pages.admin.locations', compact('user', 'locations', 'agent_mode', 'title', 'current_account', 'current_action'));
    
    }

    public function store (Request $request) {

        try {

            // Check if this not exist.
            $exist = Location::where('intitule', $request->location)->first();
            if($exist != null){
                return response('Ce localisation existe déjà', 201);
            }

            $id = DB::table('locations')->insertGetId(['id' => null, 'intitule' => $request->location]);

            $result = Array(
                'status' => 'OK',
                'record' => ['id' => $id, 'intitule' => $request->location, 'edit' => false],
            );

            return response($result, 200);
        } catch (Exception $th) {
            return response($th->getMessage(), 202);
        }

    }

    public function update (int $id, Request $request) {
        try {
            // Check if this not exist.
            $exist = Location::where('intitule', $request->location)->first();
            if($exist != null && $exist->id != $id){
                return response('Ce localisation existe déjà', 201);
            }

            $cat = Location::find($id);
            $cat->intitule = $request->location;
            $cat->update();

            $result = Array(
                'status' => 'OK',
                'record' => ['id' => $id, 'intitule' => $request->location, 'edit' => true],
            );

            return response($result, 200);
        } catch (Exception $th) {
            return response($th, 202);
        }
    }

    public function delete (int $id) {
        try {
            $cat = Location::find($id);
            $cat->delete();
            return response('', 200);
        } catch (Exception $th) {
            return response($th->getMessage(), 202);
        }
    }

}
