<?php

namespace App\Services;

use App\Models\User;
use Google\Client;
use Google\Service\Sheets;
use Google\Service\Sheets\ValueRange;

class GoogleOauthService
{
    private $client, $user_id;

    public function __construct($client_id, $client_secret)
    {
        $this->client = new Client();
        $this->client->setApplicationName('Google Sheets API PHP Quickstart');
        $this->client->setScopes(Sheets::SPREADSHEETS);
//        $this->client->setClientId($client_id);
//        $this->client->setClientSecret($client_secret);
//        $this->client->setRedirectUri(route('oauth.google.sheets.callback'));
        $this->client->setAuthConfig('credentials.json');
        $this->client->setAccessType('offline');
    }

    public function setUserId($user_id)
    {
        $this->user_id = $user_id;
    }

    public function getClient(): Client
    {
        return $this->client;
    }

    public function appendSingleRow($sheet_id, $formData)
    {
        if (\Auth::check()) {
            if (\Auth::user()->token == null) {
                return redirect()->route('oauth.google.sheets')->with('error', 'Not Authorized!');
            }
            $token = \Session::get('g_auth');
        } else {
            if ($user = User::find($this->user_id)) {
                $token = $user->token;
            }
        }

        $body = new ValueRange(['values' => [array_values($formData)]]);
        $this->client->setAccessToken($token ?? null);
        $sheets = new Sheets($this->client);
        $sheets->spreadsheets_values->append($sheet_id, 'A:Z', $body, ['valueInputOption' => 'RAW']);

        return true;
    }
}
