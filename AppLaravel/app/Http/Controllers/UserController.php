<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\PayPalPlan;

class UserController extends Controller
{
    public function index()
    {
        $users = User::paginate();

        return view('users.index', compact('users'));
    }

    public function landingPage()
    {

        $plans = PayPalPlan::all();
        if (auth()->check()) {
            if (auth()->user()->hasRole('admin')) {
                return redirect()->route('admin.dashboard');
            } else {
                return redirect()->route('myBroadcasts');
            }
        }
        return view('welcome', compact('plans'));
    }
     public function termsUse()
    {

      
        return view('terms-use');
    }
       public function privacyPolicy()
    {

      
        return view('privacy-policy');
    }
}
