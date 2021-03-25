<?php

namespace App\Http\Controllers;

use App\Models\Administrators;
use App\Models\Deployements;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DeployeController extends Controller
{
    
    public function index () {
        return view('');
    }

    /**
     * Function to store the deployement info.
     */
    public function store (Request $request) {

        // Validation.
        $validator = Validator::make($request->all(), array_merge(
            Deployements::$rules, Administrators::$rules
        ));
        if($validator->fails()){
            return back()
                ->withErrors($validator->errors())
                ->withInput($request->input());
        }

        $deploye = new Deployements();
        $deploye->create($request->all());

        $admin = new Administrators($request->all());
        $admin->deployement()->associate($deploye);

        $admin->save();

        // TODO.
    }

    
}
