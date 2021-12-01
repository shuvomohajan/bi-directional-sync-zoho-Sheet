<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateGoogleSheetIdRequest;
use Auth;
use Http;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;
use Session;

class UserController extends Controller
{
    public function updateUserGoogleSheetId(UpdateGoogleSheetIdRequest $request): RedirectResponse
    {
        if (!Session::has('g_auth')) return redirect()->route('oauth.google.sheets')->with('error', 'Not Authorized!');

        Auth::user()->update($request->validated());

        //making watch request to google push notification
        $response = Http::accept('application/json')
            ->withHeaders(["Authorization" => "Bearer " . session()->get('g_auth')['access_token']])
            ->post('https://www.googleapis.com/drive/v3/files/' . $request->validated()['google_sheet_id'] . '/watch', [
                'id'      => Str::uuid(),
                'type'    => "web_hook",
                'address' => 'https://a480-103-70-170-0.ngrok.io/api/google-get-notified/' . Auth::id(),
                //'address' => route('google.get.notified'),
            ]);
        Session::put('google_push_response', $response->body());

        return redirect()->route('google.sheets.create')->with('success', 'Sheet id stored.');
    }
}
