<?php

namespace App\Http\Controllers;

use App\Models\Agence;
use App\Utils\ControllersHelper;
use Illuminate\Http\Request;

class AgenceController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $agences = Agence::all();
        $result = Array(
            'records' => $agences
        );
        return response($result);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validation des éléments.
        $response = ControllersHelper::validated($request, Agence::$rules);
        if($response->getStatusCode() == 202)
            return $response;
        $agence = new Agence;
        $agence->codeAgence = $request->codeAgence;
        $agence->nomAgence = $request->nomAgence;
        $agence->quartier = $request->quartier;
        $result = ControllersHelper::callBackSave($agence->save(), $agence);
        return response($result, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Agence  $agence
     * @return \Illuminate\Http\Response
     */
    public function show(Agence $agence)
    {
        $result = Array(
            'record' => $agence
        );
        return response($result, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Agence  $agence
     * @return \Illuminate\Http\Response
     */
    public function edit(Agence $agence)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Agence  $agence
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Agence $agence)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Agence  $agence
     * @return \Illuminate\Http\Response
     */
    public function destroy(Agence $agence)
    {
        return response($agence->delete(), 200);
    }
}
