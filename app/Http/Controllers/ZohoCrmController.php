<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateLeadsRequest;
use Auth;
use Http;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Session;

class ZohoCrmController extends Controller
{
    public function oauthZohoCrmAuthorize(Request $request)
    {
        $request->validate([
            'client_id'     => ['required', 'string'],
            'client_secret' => ['required', 'string'],
        ]);
        Auth::user()->update([
            'zoho_client_id'     => $request->input('client_id'),
            'zoho_client_secret' => $request->input('client_secret'),
        ]);
        $response = Http::post("https://accounts.zoho.com/oauth/v2/auth?scope=ZohoCRM.modules.leads.ALL,ZohoCRM.settings.fields.ALL,ZohoSearch.securesearch.READ&client_id=" . $request->input('client_id') . "&response_type=code&access_type=offline&redirect_uri=" . route('oauth.zoho.crm.callback'));
        return redirect($response->effectiveUri());
    }

    public function oauthZohoCrmCallback(): RedirectResponse
    {
        if (isset(request()->code)) {
            $formData = [
                "grant_type"    => "authorization_code",
                "client_id"     => Auth::user()->zoho_client_id,
                "client_secret" => Auth::user()->zoho_client_secret,
                "redirect_uri"  => route('oauth.zoho.crm.callback'),
                "code"          => request()->code,
            ];
            $response = Http::asForm()->post("https://accounts.zoho.com/oauth/v2/token", $formData);
            $token = json_decode($response->body());
            Session::put('zoho_auth', $token);
            Auth::user()->update(['zoho_oauth_token' => $token]);
        }
        return redirect()->route('task.1');
    }

    public function zohoCrmStore(CreateLeadsRequest $request): RedirectResponse
    {
        if (!session()->has('zoho_auth')) return redirect()->route('oauth.zoho.crm')->with('error', 'Not Authorized!');
        //check unique email after append in zoho crm
        if ($this->uniqueCheck($request->validated()['Email']) != 0) return back()->with('error', 'Email already exist.');

        $formData = ['data' => [$request->validated()]];
        $response = Http::withHeaders(["Authorization" => "Zoho-oauthtoken " . session()->get('zoho_auth')->access_token])
            ->post("https://www.zohoapis.com/crm/v2/Leads", $formData);

        if ($response->successful()) return back()->with('success', 'Leads Created.');
        return back()->with('error', 'Somethings Wrong!');
    }

    public function uniqueCheck($email): int
    {
        $searchResponse = Http::withHeaders(["Authorization" => "Zoho-oauthtoken " . session()->get('zoho_auth')->access_token])
            ->get('https://www.zohoapis.com/crm/v2/Leads/search?email=' . $email);
        $responseData = json_decode($searchResponse->body());
        return count($responseData->data ?? []);
    }

    public function getFieldName()
    {
        $response = Http::withHeaders(["Authorization" => "Zoho-oauthtoken " . session()->get('zoho_auth')->access_token])
            ->get("https://www.zohoapis.com/crm/v2/settings/fields?module=Leads");
        return $response->body();
    }
}
