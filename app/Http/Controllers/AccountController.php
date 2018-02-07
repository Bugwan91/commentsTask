<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AccountController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function showCabinet(Request $request)
    {
        return view('cabinet', [
            'user' => $request->user()
        ]);
    }
}
