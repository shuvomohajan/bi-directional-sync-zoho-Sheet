<?php

namespace App\Http\Controllers;

use Google\Client;
use Google\Service\Sheets;
use Google\Service\Sheets\ValueRange;
use Http;
use Illuminate\Http\Request;

class Task2Controller extends Controller
{
    private $client, $sheets;

    public function __construct()
    {
        $this->client = new Client();
        $this->client->setApplicationName('Google Sheets API PHP Quickstart');
        $this->client->setScopes(Sheets::SPREADSHEETS);
        $this->client->setAuthConfig('credentials.json');
        $this->client->setAccessType('offline');

        $this->sheets = new Sheets($this->client);
    }

    public function googleSheetsStore(Request $request)
    {
        $values = [[
            $request->input('name'),
            $request->input('email'),
            $request->input('phone'),
        ]];
        $body = new ValueRange([
            'values' => $values
        ]);
        $params = [
            'valueInputOption' => 'RAW'
        ];
        $result = $this->sheets->spreadsheets_values->update($request->input('google_sheet_id'), 'A:Z', $body, $params);
        printf("%d cells updated.", $result->getUpdatedCells());
    }
}
