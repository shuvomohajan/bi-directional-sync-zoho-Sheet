<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSheetRowRequest;
use App\Services\GoogleOauthService;

class SyncController extends Controller
{
    private $googleService;

    public function __construct()
    {
        $this->googleService = new GoogleOauthService(session()->get('g_client_id'), session()->get('g_client_secret'));
    }

    public function zohoCrmGetNotified(CreateSheetRowRequest $request, $user_id)
    {
        $this->googleService->setUserId($user_id);
        $this->googleService->appendSingleRow('1aUp_GEJTzskJTkYHKb6h9azkR_QuUM8i-dZH9_hLgAk', $request->validated());
    }
}
