<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BuyPlanController extends Controller
{
    // Buy plan view

    public function buyPlan(){
        // dd($basic);
        return view('paypal.buy-plan');
    }
    
    
    

}
