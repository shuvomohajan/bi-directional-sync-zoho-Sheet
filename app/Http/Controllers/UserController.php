<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateGoogleSheetIdRequest;
use Auth;
use Illuminate\Http\RedirectResponse;

class UserController extends Controller
{
    public function updateUserGoogleSheetId(UpdateGoogleSheetIdRequest $request): RedirectResponse
    {
        Auth::user()->update($request->validated());
        return redirect()->route('google.sheets.create')->with('success', 'Sheet id stored.');
    }
}
