<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ServiceController extends Controller
{
    
    
    public function index () {

        $title = strtoupper(Auth::user()->role)  .  'GEST';
        $current_account =  'admin';
        $agent_mode = 'add';
        $user = Auth::user();
        $services = Service::all();
        $current_action = explode('/', Route::current()->uri)[1];
        return view('pages.admin.services', compact('user', 'services', 'agent_mode', 'title', 'current_account', 'current_action'));
    
    }

    public function store (Request $request) {

        try {

            // Check if this not exist.
            $exist = Service::where('intitule', $request->service)->first();
            if($exist != null){
                return response('Ce service existe déjà', 201);
            }

            $id = DB::table('services')->insertGetId(['id' => null, 'intitule' => $request->service]);

            $result = Array(
                'status' => 'OK',
                'record' => ['id' => $id, 'intitule' => $request->service, 'edit' => false],
            );

            return response($result, 200);
        } catch (Exception $th) {
            return response($th->getMessage(), 202);
        }

    }

    public function update (int $id, Request $request) {
        try {
            // Check if this not exist.
            $exist = Service::where('intitule', $request->service)->first();
            if($exist != null && $exist->id != $id){
                return response('Ce service existe déjà', 201);
            }

            $cat = Service::find($id);
            $cat->intitule = $request->service;
            $cat->update();

            $result = Array(
                'status' => 'OK',
                'record' => ['id' => $id, 'intitule' => $request->service, 'edit' => true],
            );

            return response($result, 200);
        } catch (Exception $th) {
            return response($th, 202);
        }
    }

    public function delete (int $id) {
        try {
            $cat = Service::find($id);
            $cat->delete();
            return response('', 200);
        } catch (Exception $th) {
            return response($th->getMessage(), 202);
        }
    }
}
