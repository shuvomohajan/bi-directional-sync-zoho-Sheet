<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSheetRowRequest;
use App\Models\User;
use App\Services\GoogleOauthService;
use Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Session;

class GoogleSheetsController extends Controller
{
    private $googleService, $client;

    public function oauthGoogleSheetsAuthorize(Request $request)
    {
        $request->validate([
            'client_id'     => ['required', 'string'],
            'client_secret' => ['required', 'string'],
        ]);
        Auth::user()->update([
            'google_client_id'     => $request->input('client_id'),
            'google_client_secret' => $request->input('client_secret'),
        ]);
        $this->createGoogleInstance();
        return redirect($this->client->createAuthUrl());
    }

    private function createGoogleInstance()
    {
        $this->googleService = new GoogleOauthService(Auth::user()->google_client_id, Auth::user()->google_client_secret);
        $this->client = $this->googleService->getClient();
    }

    public function oauthGoogleSheetsCallback(): RedirectResponse
    {
        if (isset(request()->code)) {
            $this->createGoogleInstance();
            $token = $this->client->fetchAccessTokenWithAuthCode(request()->code);
            Session::put('g_auth', $token);
            Auth::user()->update(['google_oauth_token' => $token]);
        }
        return redirect()->route('task.1');
    }

    public function googleSheetsStore(CreateSheetRowRequest $request): RedirectResponse
    {
        if (!Session::has('g_auth')) return redirect()->route('oauth.google.sheets')->with('error', 'Not Authorized!');

        $this->createGoogleInstance();
        if ($this->googleService->appendSingleRow(Session::get('g_auth'), Auth::user()->google_sheet_id, $request->validated()))
            return back()->with('success', 'Data added successfully.');

        return back()->with('error', 'Somethings wrong!');
    }
}
