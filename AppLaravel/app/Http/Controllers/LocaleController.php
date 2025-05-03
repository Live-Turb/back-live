<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;

class LocaleController extends Controller
{
    public function locale(Request $request,$slug){
        
         session()->put('locale', $request->lang);

        // dd(session()->get('local'));
        App::setLocale($slug);

        return redirect()->back();
    }
}
