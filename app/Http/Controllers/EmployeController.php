<?php

namespace App\Http\Controllers;

use App\Models\Employe;
use App\Utils\ControllersHelper;
use CreateEmployesTable;
use Illuminate\Http\Request;

class EmployeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $emploies = Employe::all();
        return view('pages.employe.index', compact('emploies'));
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
        // Validation.
        $response = ControllersHelper::validated($request, Employe::$rules);
        if($response->getStatusCode() == 202)
            return $response;
        // Save.
        $employe = new Employe;
        $employe->codeEmploye = $request->codeEmploye;
        $employe->nomComplet = $request->nomComplet;
        $employe->adresse = $request->adresse;
        $employe->telephone = $request->telephone;
        $employe->cni = $request->cni;
        $employe->autreContact = $request->autreContact;
        $employe->emailemp = $request->emailemp;
        $employe->sonAgence = $request->sonAgence;
        $result = ControllersHelper::callBackSave($employe->save(), $employe);
        return response($result, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Employe  $employe
     * @return \Illuminate\Http\Response
     */
    public function show($code)
    {
        $result = Array(
            'status' => 'OK',
            'record' => Employe::find($code)
        );
        return response($result, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Employe  $employe
     * @return \Illuminate\Http\Response
     */
    public function edit(Employe $employe)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Employe  $employe
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employe $employe)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employe  $employe
     * @return \Illuminate\Http\Response
     */
    public function destroy($code)
    {
        $employe = Employe::find($code);
        $result = Array(
            'status' => 'ok',
            'records' => $employe == null ? false : $employe->delete(),
        );
        return response($result, 200);
    }
}
