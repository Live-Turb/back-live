<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\Request;
use App\Models\User;

class ProfileController extends Controller
{
    public function show()
    {
        return view('auth.profile');
    }

    public function update(ProfileUpdateRequest $request)
    {
        if ($request->password) {
            auth()->user()->update(['password' => Hash::make($request->password)]);
        }

        auth()->user()->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        return redirect()->back()->with('success', 'Profile updated.');
    }

    public function updateProfile(Request $request, $id)
    {
        $user = User::findOrFail($id);
        
        // Validações dos campos de entrada
        $request->validate([
            'name' => 'required|string|max:255',
            'profile_picture' => 'nullable|mimes:jpg,jpeg,png|max:10240',
            'facebook_pixel' => 'nullable|string',
            'google_ads_pixel' => 'nullable|string',
            'tiktok_pixel' => 'nullable|string',
        ]);

        // Atualiza o nome do usuário
        $user->name = $request->name;

        // Atualiza a foto de perfil, se fornecida
        if ($request->hasFile('profile_picture')) {
            $profilePicturePath = $request->file('profile_picture')->store('profile_picture', 'public');
            $user->profile_picture = $request->file('profile_picture')->getClientOriginalName();
            $user->profile_picture_path = $profilePicturePath;
        }

        // Atualiza a senha, se fornecida
        if ($request->filled('new_password') || $request->filled('c_password')) {
            $request->validate([
                'current_password' => 'required',
                'new_password' => 'required|min:8',
                'c_password' => 'required|same:new_password',
            ]);

            if (!Hash::check($request->current_password, $user->password)) {
                return redirect()->back()->withErrors(['current_password' => __('dashboard.current_password_incorrect')])
                                         ->withInput($request->except('current_password', 'new_password', 'c_password'));
            }

            $user->password = Hash::make($request->new_password);
        }

        // Atualiza os campos de Pixels de Rastreamento
        $user->facebook_pixel = $request->facebook_pixel;
        $user->google_ads_pixel = $request->google_ads_pixel;
        $user->tiktok_pixel = $request->tiktok_pixel;

        // Salva as alterações no banco de dados
        $user->save();

        return redirect()->back()->with('success', __('dashboard.profile_updated_successfully'));
    }

    public function profileManagement()
    {
        // Obtém o usuário autenticado
        $user = auth()->user();

        // Retorna a view com os dados do usuário
        return view('profile-management', compact('user'));
    }
}
