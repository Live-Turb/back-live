<?php

namespace App\Http\Controllers;

use App\Models\PayPalPlan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Mail\UserRegistrationMail;
use Illuminate\Support\Facades\Mail;

class CustomRegisterController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }

    // Register form view
    // public function registerForm($amount, $basic)
    // {
    //     // dd($amount);

    //     return view('auth.register',compact('amount','basic'));
    // }


    // public function registerForm($planType, $planId, $planPrice, $planDuration)
    // {


    //     // dd($planDuration);
    //     // dd($planType);
    //     // dd($planPrice);
    //     // dd($planId);

    //     return view('auth.register', compact('planType', 'planId', 'planPrice', 'planDuration'));
    // }
    public function registerForm($uuid)
    {
        $plan = PayPalPlan::where('uuid', $uuid)->first();
        if ($plan) {
            return view('auth.register', compact('plan'));
        }
        return redirect()->back();
    }

    // User store into database

    public function userStore(Request $request, $uuid)
    {
    
        $plan = PayPalPlan::where('uuid', $uuid)->first();
        if (!$plan) {
            return redirect()->route('landing')->with(['error' => 'Something went wrong']);
        }

        // Validação do reCAPTCHA
        if (!$request->has('g-recaptcha-response')) {
            return back()->withErrors(['recaptcha' => 'Por favor, verifique o reCAPTCHA.'])->withInput();
        }

        $recaptchaResponse = $request->input('g-recaptcha-response');
        $response = \Illuminate\Support\Facades\Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
            'secret' => config('recaptcha.secret_key'),
            'response' => $recaptchaResponse,
            'remoteip' => $request->ip()
        ]);

        if (!$response->json('success')) {
            return back()->withErrors(['recaptcha' => 'Falha na verificação do reCAPTCHA. Por favor, tente novamente.'])->withInput();
        }

        // session()->put('email', $request->email);

        $request->validate(
            [
                'name' => ['required', 'string', 'min:3'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'whatsapp_no' => ['required', 'min:8','max:16'],
                'password' => ['required', 'min:8', 'regex: /(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$/'],
                'password_confirmation' => 'required_with:password|same:password',
                'payment_method' => 'required',
            'profile_picture' => 'nullable|mimes:jpg,jpeg,png|max:10240',

            ],
            [
           'name.min' => __('validation.name.min'),
        'email.email' => __('validation.email.email'),
        'password.min' => __('validation.password.min'),
        'password.regex' => __('validation.password.regex'),
        'payment_method.required' => __('validation.payment_method.required'),
        'profile_picture.mimes' => __('validation.profile_picture.mimes'),
        'profile_picture.max' => __('validation.profile_picture.max')

            ]
        );

       $profilePicture = null;
    $profilePicturePath = null;


        if ($request->hasFile('profile_picture')) {
        $profilePicture = $request->file('profile_picture')->getClientOriginalName();
        $profilePicturePath = $request->file('profile_picture')->storeAs('profile_picture', $profilePicture, 'public');
    }

    $user = User::create([
        'uuid' => \Str::uuid(),
        'name' => $request->name,
        'email' => $request->email,
        'password' => \Hash::make($request->password),
        'status' => "pending",
        'profile_picture' => $profilePicture,
        'profile_picture_path' => $profilePicturePath,
    ]);

        $user->assignRole('user');
        
        
         $data = [
        'email' => $request->email,
        'password' => $request->password, 
    ];

    try {
        Mail::to($user->email)->send(new UserRegistrationMail($data));
    } catch (\Exception $e) {
        // Log the error silently
        \Log::error('Failed to send registration email: ' . $e->getMessage());
    }
        
        // dd('dd');
        if($request->payment_method == 'paypal'){
            
            return view('paypal.process-to-continue', compact('plan', 'user'));
        }elseif($request->payment_method == 'stripe'){
            return app(StripeController::class)->processStripeTransaction($request, $plan->uuid, $user->uuid);  
        }
        elseif ($request->payment_method == 'mercado_pago') {
    return app(MercadoPagoController::class)->processMercadoPagoTransaction($request, $plan->uuid, $user->uuid);
}
        // return redirect()->route('processToContinue');
    }
}
