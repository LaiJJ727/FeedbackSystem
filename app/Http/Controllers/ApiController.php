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
            $isOnSend = $api->in_used;
            $api = $api->api;
            $check ="none";
        }
        return view('admin/apiSetting')->with('api', $api)->with('check',$check)->with('isOnSend',$isOnSend);
    }
    public function apiEdit()
    {
        if (API::find(1) == null) {
            $api = '';
            $check ="edit";
        } else {
            $api = API::find(1);
            $isOnSend = $api->in_used;
            $api = $api->api;
            $check ="edit";
        }
        return view('admin/apiSetting')->with('api', $api)->with('check',$check)->with('isOnSend',$isOnSend);
    }
    public function apiUpadate()
    {
        $r = request();

        if (API::find(1) == null) {
            $api = API::create([
                'api' => $r->key,
                'service_name' => 'OnSend',
                'service_type' => 'Whatsapp',
                'in_used' => $r->switch,
            ]);
        } else {
            $api= API::find(1)->first();
            $api->api = $r->key;
            $api->in_used = $r->switch;
            $api->save();

        }
        return redirect()->route('api_setting');
    }
}
