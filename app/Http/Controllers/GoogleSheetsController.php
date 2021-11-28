<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSheetRowRequest;
use App\Services\GoogleOauthService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Session;

class GoogleSheetsController extends Controller
{
    private $googleService, $client;

    public function __construct()
    {
        $this->setClientCredentials();
        $this->googleService = new GoogleOauthService(session()->get('g_client_id'), session()->get('g_client_secret'));
        $this->client = $this->googleService->getClient();
    }

    private function setClientCredentials()
    {
        if (request()->client_id && request()->client_secret) {
            session()->put('g_client_id', request()->client_id);
            session()->put('g_client_secret', request()->client_secret);
        }
    }

    public function oauthGoogleSheetsAuthorize(Request $request)
    {
        return redirect($this->client->createAuthUrl());
    }

    public function oauthGoogleSheetsCallback(): RedirectResponse
    {
        if (isset(request()->code)) {
            $token = $this->client->fetchAccessTokenWithAuthCode(request()->code);
            Session::put('g_auth', $token);
            auth()->user()->update(['token' => $token['access_token']]);
        }
        return redirect()->route('task.1');
    }

    public function googleSheetsStore(CreateSheetRowRequest $request): RedirectResponse
    {
        if ($this->googleService->appendSingleRow('1aUp_GEJTzskJTkYHKb6h9azkR_QuUM8i-dZH9_hLgAk', $request->validated()))
            return back()->with('success', 'Data added successfully.');

        return back()->with('error', 'Somethings wrong!');
    }
}
