<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Subscription;
use App\Models\VideoDetail;
use App\Models\PayPalPlan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;

class UserController extends Controller
{
    public function users(Request $request)
    {
        $search = $request->input('search');

        $query = User::whereHas('roles', function ($q) {
            $q->where('name', 'user');
        });

        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        $users = $query->paginate(10)->withQueryString();

        return view("admin.users", compact('users'));
    }

    /**
     * Exibe o formulário para criação de novo usuário
     */
    public function create()
    {
        $plans = PayPalPlan::all();
        return view("admin.create-user", compact('plans'));
    }

    /**
     * Armazena um novo usuário no banco de dados
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:8',
            'plan_id' => 'nullable|exists:pay_pal_plans,id',
            'expire_date' => 'nullable|date',
            'status' => 'nullable|in:pending,active,blocked,expired'
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->uuid = Str::uuid();
        $user->status = $request->status;
        $user->save();

        // Atribuir função 'user'
        $user->assignRole('user');

        // Criar assinatura se um plano foi selecionado
        if ($request->plan_id) {
            $subscription = new Subscription();
            $subscription->user_id = $user->id;
            $subscription->plan_id = $request->plan_id;
            $subscription->status = 'ACTIVE';
            $subscription->start_time = now();
            $subscription->expire_date = $request->expire_date ?? now()->addMonth();
            $subscription->save();
        }

        return redirect()->route('admin.users')->with('success', __('dashboard.user_created_successfully'));
    }

    public function users_edit($uuid)
    {
        $user = User::where('uuid', $uuid)->first();
        $plans = PayPalPlan::all();
        $subscription = $user->subscriptions()->where('status', 'ACTIVE')->first();

        // Definir o plano atual do usuário (se existir)
        $userPlan = $subscription ? $subscription->plan_id : null;

        // Definir a data de expiração (se existir)
        $expirationDate = $subscription ? Carbon::parse($subscription->expire_date)->format('Y-m-d') : null;

        // Descriptografar ou criar senha temporária para visualização
        $plainPassword = 'Senha criptografada não pode ser recuperada';

        return view("admin.edit-user", compact('user', 'plans', 'subscription', 'userPlan', 'expirationDate', 'plainPassword'));
    }


    public function users_update(Request $request, $uuid)
    {
        $user = User::where('uuid', $uuid)->first();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'plan_id' => 'nullable|exists:pay_pal_plans,id',
            'expire_date' => 'nullable|date',
            'status' => 'nullable|in:pending,active,blocked,expired'
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->status = $request->status;
        $user->save();

        // Atualizar ou criar assinatura
        $subscription = $user->subscriptions()->first();

        if ($request->plan_id) {
            if ($subscription) {
                // Atualiza assinatura existente
                $subscription->plan_id = $request->plan_id;
                $subscription->expire_date = $request->expire_date;
                $subscription->save();
            } else {
                // Cria nova assinatura
                $subscription = new Subscription();
                $subscription->user_id = $user->id;
                $subscription->plan_id = $request->plan_id;
                $subscription->status = 'ACTIVE';
                $subscription->start_time = now();
                $subscription->expire_date = $request->expire_date ?? now()->addMonth();
                $subscription->save();
            }
        }

        return redirect()->route('admin.users')->with('success', __('dashboard.user_updated_successfully'));
    }

    /**
     * Atualiza a senha do usuário
     */
    public function updatePassword(Request $request, $uuid)
    {
        $user = User::where('uuid', $uuid)->first();

        $request->validate([
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('admin.users.edit', $user->uuid)->with('success', __('dashboard.password_updated_successfully'));
    }

    /**
     * Alterna o status do usuário (ativo/inativo)
     */
    public function toggleUserStatus($uuid)
    {
        $user = User::where('uuid', $uuid)->first();

        if ($user) {
            // Alternar entre 'active' e 'blocked'
            if ($user->status == 'active') {
                $user->status = 'blocked';
            } else {
                $user->status = 'active';
            }
            $user->save();

            $statusMessage = $user->status == 'active' ? __('dashboard.user_activated') : __('dashboard.user_deactivated');
            return redirect()->route('admin.users')->with('success', $statusMessage);
        }

        return redirect()->route('admin.users')->with('error', __('dashboard.user_not_found'));
    }

    public function users_delete($uuid)
    {
        $user = User::where('uuid', $uuid)->first();

        if ($user) {

            Subscription::where('user_id', $user->id)->delete();
                $videoDetails = VideoDetail::where('user_id', $user->id)->get();

            foreach ($videoDetails as $videoDetail) {
                $videoDetail->videoThumbnail()->delete();
                $videoDetail->videoComment()->delete();
                $videoDetail->delete();
            }
            $user->delete();

        return redirect()->route('admin.users')->with('success', __('dashboard.user_and_subscriptions_deleted_successfully'));
        } else {
        return redirect()->route('admin.users')->with('error', __('dashboard.user_not_found'));
        }
    }
}
