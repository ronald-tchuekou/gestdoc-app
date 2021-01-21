<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Utils\ControllersHelper;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = Client::all();
        $result = Array(
            'record' => $clients
        );
        return view('pages.client.index', compact('clients'));
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
        $response = ControllersHelper::validated($request, Client::$rules);
        if($response->getStatusCode() == 202)
            return $response;
        // Save.
        $client = new Client;
        $client->nomClient = $request->nomClient;
        $client->adresse = $request->adresse;
        $client->telephoneClient = $request->telephoneClient;
        $client->emailClient = $request->emailClient;
        $client->numContr = $request->numContr;
        $client->registCom = $request->registCom;
        $client->agences = $request->agences;
        $client->categorieClient = $request->categorieClient;
        $client->avoirs = $request->avoirs;
        $result = ControllersHelper::callBackSave($client->save(), $client);
        return response($result, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        $result = Array(
            'status' => 'OK',
            'record' => $client
        );
        return response($result, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Client  $celitn
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Client $client)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
        $result = Array(
            'status' => 'ok',
            'records' => $client->delete(),
        );
        return response($result, 200);
    }
}
