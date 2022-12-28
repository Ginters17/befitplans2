<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class SettingsController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(auth()->user()) {
            $user = auth()->user();
            return view('settingsPage')->with('strava_api_auhtorized', $user->strava_api_auhtorized);
        }
        else {
            return redirect('/login');
        }
    }
}
