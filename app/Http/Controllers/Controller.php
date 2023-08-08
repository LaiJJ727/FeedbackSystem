<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function testing(Request $request){
        $response = $request->name;
        if($response != "aaa"){
            $response = "error 400 badrequest";
            return response()->json($response, 400);
        }
        //$response = $request->name;
        return response()->json($response, 200);
    }
}
