<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class AdminDashboardController extends Controller
{
    public function index()
    {
    $usersCount = \App\Models\User::role('user')->count();

    $videoDetailsCount = \App\Models\VideoDetail::count();
         return view('admin.dashboard', compact('usersCount', 'videoDetailsCount'));
    }
    
    
    
            public function settings(){
        // dd($basic);
        return view('admin.settings');
    }
    
    
public function updatePaymentSettings(Request $request)
{
    // Validation rules
    $validator = Validator::make($request->all(), [
        'stripe_secret' => 'required|string',
        'mercado_pago_access_token' => 'required|string',
        'paypal_mode' => 'required|string|in:sandbox,live',
        'paypal_sandbox_client_id' => 'required|string',
        'paypal_sandbox_client_secret' => 'required|string',
    ]);

    // Handle validation errors
    if ($validator->fails()) {
        return back()->withErrors($validator)->withInput();
    }

    $data = $request->only([
        'stripe_secret',
        'mercado_pago_access_token',
        'paypal_mode',
        'paypal_sandbox_client_id',
        'paypal_sandbox_client_secret',
    ]);

    $envPath = base_path('.env');

    // Update .env file
    if (File::exists($envPath)) {
        foreach ($data as $key => $value) {
            // Replace the existing value or add a new one
            file_put_contents($envPath, preg_replace(
                "/^" . strtoupper($key) . "=.*/m",
                strtoupper($key) . "=\"" . $value . "\"",
                file_get_contents($envPath)
            ));
        }
    }

    // Clear the config cache
    Artisan::call('config:clear');

    return back()->with('success', 'Payment settings updated successfully.');
}


}
