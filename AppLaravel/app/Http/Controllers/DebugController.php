<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DebugController extends Controller
{
    public function writeLog(Request $request)
    {
        $data = $request->all();
        
        // Verifica se os logs de debug estão habilitados
        if (config('app.debug_logs_enabled', false)) {
            Log::info('Debug log:', $data);
        }
        
        return response()->json(['status' => 'success']);
    }
}
