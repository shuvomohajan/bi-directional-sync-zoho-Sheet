<?php

namespace App\Http\Controllers;

use Http;
use Illuminate\Http\Request;

class ZohoCrmController extends Controller
{
    public function oauthZohoCrmAuthorize(Request $request)
    {
        $response = Http::post("https://accounts.zoho.com/oauth/v2/auth?scope=ZohoCRM.leads.ALL&client_id=". $request->input('client_id') ."&response_type=code&access_type=offline&redirect_uri=" . route('oauth.zoho.crm.callback'));

        dd($response);
        return redirect();
    }
}
