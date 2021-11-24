<?php

namespace App\Http\Controllers;

use Google\Client;
use Google\Service\Sheets;
use Google\Service\Sheets\ValueRange;
use Illuminate\Http\Request;

class GoogleSheetsController extends Controller
{
    private $client, $sheets;

    public function __construct()
    {
        $this->client = new Client();
        $this->client->setApplicationName('Google Sheets API PHP Quickstart');
        $this->client->setScopes(Sheets::SPREADSHEETS);
        $this->client->setRedirectUri(route('oauth.google.sheets.callback'));
        $this->client->setAuthConfig('credentials.json');
        $this->client->setAccessType('offline');
        $this->sheets = new Sheets($this->client);
    }

    public function oauthGoogleSheetsAuthorize(Request $request)
    {
        $authUrl = $this->client->createAuthUrl();
        return redirect($authUrl);
    }

    public function oauthGoogleSheetsCallback()
    {
        if (isset(request()->code)) {
            $token = $this->client->fetchAccessTokenWithAuthCode(request()->code);
            \Session::put('g_auth', $token);
        }
        return redirect()->route('task.1');
    }

    // task 2
    public function googleSheetsStore(Request $request)
    {
        $token = session()->get('g_auth');
        $this->client->setAccessToken($token);

        $values = [[
            $request->input('name'),
            $request->input('email'),
            $request->input('phone'),
        ],];
        $body = new ValueRange([
            'values' => $values
        ]);
        $params = [
            'valueInputOption' => 'RAW'
        ];
        $this->sheets->spreadsheets_values->append($request->input('google_sheet_id'), 'A:Z', $body, $params);
        return back()->with('success', 'Data added successfully.');
    }
}
