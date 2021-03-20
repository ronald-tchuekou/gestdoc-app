<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

class CategoryController extends Controller
{
    
    public function index () {

        $title = strtoupper(Auth::user()->role)  .  'GEST';
        $current_account =  'admin';
        $agent_mode = 'add';
        $user = Auth::user();
        $categories = Categorie::all();
        $current_action = explode('/', Route::current()->uri)[1];
        return view('pages.admin.categories', compact('user', 'categories', 'agent_mode', 'title', 'current_account', 'current_action'));
    
    }

    public function store (Request $request) {

        try {

            // Check if this not exist.
            $exist = Categorie::where('intitule', $request->category)->first();
            if($exist != null){
                return response('Cette categorie existe déjà', 201);
            }

            $id = DB::table('categories')->insertGetId(['id' => null, 'intitule' => $request->category]);

            $result = Array(
                'status' => 'OK',
                'record' => ['id' => $id, 'intitule' => $request->category, 'edit' => false],
            );

            return response($result, 200);
        } catch (Exception $th) {
            return response($th->getMessage(), 202);
        }

    }

    public function update (int $id, Request $request) {
        try {
            // Check if this not exist.
            $exist = Categorie::where('intitule', $request->category)->first();
            if($exist != null && $exist->id != $id){
                return response('Cette categorie existe déjà', 201);
            }

            $cat = Categorie::find($id);
            $cat->intitule = $request->category;
            $cat->update();

            $result = Array(
                'status' => 'OK',
                'record' => ['id' => $id, 'intitule' => $request->category, 'edit' => true],
            );

            return response($result, 200);
        } catch (Exception $th) {
            return response($th, 202);
        }
    }

    public function delete (int $id) {
        try {
            $cat = Categorie::find($id);
            $cat->delete();
            return response('', 200);
        } catch (Exception $th) {
            return response($th->getMessage(), 202);
        }
    }
}
