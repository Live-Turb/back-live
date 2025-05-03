<?php

namespace App\Policies;

use App\Models\User;
use App\Models\ViewBillingRecord;
use Illuminate\Auth\Access\HandlesAuthorization;

class ViewBillingRecordPolicy
{
    use HandlesAuthorization;

    /**
     * Determine se o usuário pode ver o registro de cobrança.
     */
    public function view(User $user, ViewBillingRecord $billingRecord)
    {
        return $user->id === $billingRecord->user_id;
    }

    /**
     * Determine se o usuário pode ver a lista de cobranças.
     */
    public function viewAny(User $user)
    {
        return true; // Todos usuários autenticados podem ver sua própria lista
    }

    /**
     * Determine se o usuário pode atualizar o registro de cobrança.
     */
    public function update(User $user, ViewBillingRecord $billingRecord)
    {
        // Apenas o dono do registro pode processá-lo e apenas se estiver pendente
        return $user->id === $billingRecord->user_id && $billingRecord->status === 'pending';
    }

    /**
     * Determine se o usuário pode processar uma cobrança pendente.
     */
    public function process(User $user, ViewBillingRecord $billingRecord)
    {
        // Apenas o dono do registro pode processá-lo e apenas se estiver pendente
        return $user->id === $billingRecord->user_id && $billingRecord->status === 'pending';
    }
}
