<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSheetRowRequest;
use App\Models\User;
use App\Services\GoogleOauthService;
use Illuminate\Support\Facades\Log;

class SyncController extends Controller
{
    public function zohoCrmGetNotified(CreateSheetRowRequest $request, User $user)
    {
        $googleService = new GoogleOauthService($user->google_client_id, $user->google_client_secret);
        $googleService->appendSingleRow($user->google_oauth_token, $user->google_sheet_id, $request->validated());
    }

    public function googleGetNotifies(User $user)
    {
        Log::info('Google get notified');
        $googleService = new GoogleOauthService($user->google_client_id, $user->google_client_secret);
        $sheetData = $googleService->getSheetData($user->google_oauth_token, $user->google_sheet_id, 'A:E');

        $key = $sheetData[0];
        foreach ($sheetData as $k => $value) {
            if($k == 0) continue;

            $combine_value = array_combine($key, $value);
            if($this->uniqueCheck($user->zoho_oauth_token['access_token'], $combine_value['Email']) != 0) continue;

            $formData = ['data' => [$combine_value]];
            \Http::withHeaders(["Authorization" => "Zoho-oauthtoken " . $user->zoho_oauth_token['access_token']])
                ->post("https://www.zohoapis.com/crm/v2/Leads", $formData);
        }
    }

    public function uniqueCheck($token, $email): int
    {
        $searchResponse = \Http::withHeaders(["Authorization" => "Zoho-oauthtoken " . $token])
            ->get('https://www.zohoapis.com/crm/v2/Leads/search?email=' . $email);
        $responseData = json_decode($searchResponse->body());
        return count($responseData->data ?? []);
    }
}
