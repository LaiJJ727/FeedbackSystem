<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\API;

class ApiController extends Controller
{
    public function api()
    {
        if (API::find(1) == null) {
            $check = 'none';
            $api ="none";
        } else {
            $api = API::find(1);
            $api = $api->api;
            $check ="none";
        }
        return view('admin/apiSetting')->with('api', $api)->with('check',$check);
    }
    public function apiEdit()
    {
        if (API::find(1) == null) {
            $api = '';
            $check ="edit";
        } else {
            $api = API::find(1);
            $api = $api->api;
            $check ="edit";
        }
        return view('admin/apiSetting')->with('api', $api)->with('check',$check);
    }
    public function apiUpadate()
    {
        $r = request();

        if (API::find(1) == null) {
            $api = API::create([
                'api' => $r->key,
            ]);
        } else {
            $api= API::find(1)->first();
            $api->api = $r->key;
            $api->save();

        }
        return redirect()->route('api_setting');
    }
}
