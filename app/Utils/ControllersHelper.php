<?php

namespace App\Utils;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ControllersHelper {

    /**
     * Fonction de validation.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @param   Array $rules
     * @return \Illuminate\Http\Response
     */
    public static function validated (Request $request, array $rules){
        $validation = Validator::make($request->all(), $rules);
        if($validation->fails()){
            $result = Array(
                'record' => [
                    'state' => false,
                    'errors' => $validation->errors(),
                ]
            );
            return response($result, 202);
        }
        return response('', 201);
    }
    
    /**
     * Fonction qui retourn le result.
     */
    public static function callBackSave(bool $state, Object $object){
        if($state){
            $result = Array(
                'record' => [
                    'state' => true,
                    'data' => $object,
                ]
            );
        }else{
            $result = Array(
                'record' => [
                    'state' => false,
                    'data' => $object->error_log,
                ]
            );
        }
        return $result;
    }

}
