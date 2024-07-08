<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Login;
use App\Http\Services\Admin\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function login(Login $request)
    {
        $validated = $request->validated();
        if(Auth::attempt($validated)) {
            return view('welcome');
        }
        else {
            return back()->withErrors(['password' => 'Incorrect Password!'])->withInput();
        }
    }
}
