<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
class LogoutController extends Controller
{
    public function perform()
    {
        Session::flush();
        
        Auth::logout();

        return redirect('login');
    }
}
