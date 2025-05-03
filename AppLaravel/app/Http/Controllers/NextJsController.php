<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NextJsController extends Controller
{
    public function index($path = null)
    {
        $nextJsUrl = config('app.next_js_url', 'https://app.liveturb.com');
        $fullUrl = $nextJsUrl . "/escalando-agora";

        if ($path) {
            $fullUrl .= "/{$path}";
        }

        return redirect()->away($fullUrl);
    }
}
