<?php

namespace App\Services;

use Exception;
use Google\Client;
use Google\Service\Sheets;
use Google\Service\Sheets\ValueRange;

class GoogleOauthService
{
    private $client, $sheet;

    public function __construct($client_id, $client_secret)
    {
        $this->client = new Client();
        $this->client->setApplicationName('Bitcode Tasks');
        $this->client->setScopes([Sheets::SPREADSHEETS, Sheets::DRIVE_READONLY]);
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
            //check unique email after append in sheet
            $sheetData = $this->getSheetData($token, $sheet_id, 'C:C');
            foreach ($sheetData as $value) {
                if ($formData['email'] == $value[0]) return false;
            }

            $body = new ValueRange(['values' => [array_values($formData)]]);
            $this->sheet->spreadsheets_values->append($sheet_id, 'A:Z', $body, ['valueInputOption' => 'RAW']);
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    public function getSheetData($token, $sheet_id, $range)
    {
        $this->client->setAccessToken($token);
        $this->sheet = new Sheets($this->client);
        $response = $this->sheet->spreadsheets_values->get($sheet_id, $range);
        return $response->getValues();
    }
}
