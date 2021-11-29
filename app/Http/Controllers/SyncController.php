<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSheetRowRequest;
use App\Models\User;
use App\Services\GoogleOauthService;

class SyncController extends Controller
{
    public function zohoCrmGetNotified(CreateSheetRowRequest $request, User $user)
    {
        $googleService = new GoogleOauthService($user->google_client_id, $user->google_client_secret);
        $googleService->appendSingleRow($user->google_oauth_token, $user->google_sheet_id, $request->validated());
    }
}
