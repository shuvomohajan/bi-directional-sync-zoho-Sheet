<?php

namespace App\Services;

use Google\Client;
use Google\Service\Sheets;
use Google\Service\Sheets\ValueRange;

class GoogleOauthService
{
    private $client;

    public function __construct($client_id, $client_secret)
    {
        \Log::info('Client Id >> ' . $client_id . 'Client Secret >> ' . $client_secret);

        $this->client = new Client();
        $this->client->setApplicationName('Bitcode Tasks');
        $this->client->setScopes(Sheets::SPREADSHEETS);
        $this->client->setClientId($client_id);
        $this->client->setClientSecret($client_secret);
        $this->client->setRedirectUri(route('oauth.google.sheets.callback'));
        $this->client->setAccessType('offline');
    }

    public function getClient(): Client
    {
        return $this->client;
    }

    public function appendSingleRow($token, $sheet_id, $formData): bool
    {
        try {
            $this->client->setAccessToken($token);
            $sheets = new Sheets($this->client);

            $response = $sheets->spreadsheets_values->get($sheet_id, 'C:C');
            foreach ($response->getValues() as $value) {
                if ($formData['email'] == $value[0]) return false;
            }

            $body = new ValueRange(['values' => [array_values($formData)]]);
            $sheets->spreadsheets_values->append($sheet_id, 'A:Z', $body, ['valueInputOption' => 'RAW']);
            return true;
        }catch (\Exception $e) {
            return false;
        }
    }
}
