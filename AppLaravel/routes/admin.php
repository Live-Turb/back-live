<?php
use App\Http\Controllers\Admin\PlanController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\KpiController;
use App\Http\Controllers\Admin\AnuncioController;
use App\Http\Controllers\Admin\CriativoController;


Route::middleware(['adminCheck', 'check.status'])->prefix('admin')->group(function () {
    // Redirecionar a rota / para o painel KPI
    Route::get('/', function() {
        return redirect()->route('admin.kpi.dashboard');
    })->name('admin.dashboard');

    Route::get('/users', [UserController::class, 'users'])
        ->name('admin.users');

    // Novas rotas para criação de usuário
    Route::get('/users/create', [UserController::class, 'create'])
        ->name('admin.users.create');
    Route::post('/users', [UserController::class, 'store'])
        ->name('admin.users.store');

    Route::get('/settings', [AdminDashboardController::class, 'settings'])
        ->name('admin.settings');

    Route::post('/admin/update-payment-settings', [AdminDashboardController::class, 'updatePaymentSettings'])->name('update.payment.settings');

    // Rotas existentes com modificações
    Route::get('/users/{uuid}/edit', [UserController::class, 'users_edit'])
        ->name('admin.users.edit');
    Route::put('/users/{uuid}', [UserController::class, 'users_update'])->name('admin.users.update');
    Route::delete('/users/{uuid}', [UserController::class, 'users_delete'])->name('admin.users.delete');

    // Nova rota para alteração de senha
    Route::put('/users/{uuid}/update-password', [UserController::class, 'updatePassword'])
        ->name('admin.users.update.password');

    // Nova rota para alteração de status (bloqueio/desbloqueio)
    Route::put('/users/{uuid}/toggle-status', [UserController::class, 'toggleUserStatus'])
        ->name('admin.users.toggle.status');


    Route::get('/plans', [PlanController::class, 'plans'])
        ->name('admin.plans');

    Route::get('/create/plan', [PlanController::class, 'create'])->name('admin.plan.create');
    Route::post('store/plan', [PlanController::class, 'store'])->name('admin.plan.store');
    Route::get('plan/{uuid}/edit', [PlanController::class, 'edit'])->name('admin.plan.edit');
    Route::delete('plan/{uuid}/delete', [PlanController::class, 'delete'])->name('admin.plan.delete');
    Route::post('plan/{uuid}/update', [PlanController::class, 'update'])->name('admin.plan.update');

    // Novas rotas para o painel de KPIs
    Route::get('/kpi', [KpiController::class, 'index'])->name('admin.kpi.dashboard');

    // Rotas para APIs de dados
    Route::get('/kpi/api/users-geographic', [KpiController::class, 'getUsersGeographicData'])->name('admin.kpi.api.users-geographic');
    Route::get('/kpi/api/users-online-geographic', [KpiController::class, 'getUsersOnlineGeographicData'])->name('admin.kpi.api.users-online-geographic');
    Route::get('/kpi/api/active-templates', [KpiController::class, 'getActiveTemplatesData'])->name('admin.kpi.api.active-templates');
    Route::get('/kpi/api/revenue', [KpiController::class, 'getRevenueData'])->name('admin.kpi.api.revenue');
    Route::get('/kpi/api/session-time', [KpiController::class, 'getSessionTimeData'])->name('admin.kpi.api.session-time');
    Route::get('/kpi/api/expenses', [KpiController::class, 'getExpensesData'])->name('admin.kpi.api.expenses');
    Route::get('/kpi/api/cancellation-rate', [KpiController::class, 'getCancellationRateData'])->name('admin.kpi.api.cancellation-rate');
    Route::get('/kpi/api/user-growth', [KpiController::class, 'getUserGrowthData'])->name('admin.kpi.api.user-growth');
    Route::get('/kpi/api/total-users', [KpiController::class, 'getTotalUsersData'])->name('admin.kpi.api.total-users');
    Route::get('/kpi/api/total-revenue', [KpiController::class, 'getTotalRevenueData'])->name('admin.kpi.api.total-revenue');

    // Rotas para gestão de despesas
    Route::get('/kpi/expenses', [KpiController::class, 'expenses'])->name('admin.kpi.expenses');
    Route::get('/kpi/expenses/create', [KpiController::class, 'createExpense'])->name('admin.kpi.expenses.create');
    Route::post('/kpi/expenses', [KpiController::class, 'storeExpense'])->name('admin.kpi.expenses.store');
    Route::get('/kpi/expenses/{expense}/edit', [KpiController::class, 'editExpense'])->name('admin.kpi.expenses.edit');
    Route::put('/kpi/expenses/{expense}', [KpiController::class, 'updateExpense'])->name('admin.kpi.expenses.update');
    Route::delete('/kpi/expenses/{expense}', [KpiController::class, 'deleteExpense'])->name('admin.kpi.expenses.destroy');

    // Rotas para gestão de anúncios
    Route::resource('anuncios', AnuncioController::class)->names([
        'index' => 'admin.anuncios.index',
        'create' => 'admin.anuncios.create',
        'store' => 'admin.anuncios.store',
        'show' => 'admin.anuncios.show',
        'edit' => 'admin.anuncios.edit',
        'update' => 'admin.anuncios.update',
        'destroy' => 'admin.anuncios.destroy',
    ]);

    Route::resource('criativos', CriativoController::class)->names([
        'index' => 'admin.criativos.index',
        'create' => 'admin.criativos.create',
        'store' => 'admin.criativos.store',
        'show' => 'admin.criativos.show',
        'edit' => 'admin.criativos.edit',
        'update' => 'admin.criativos.update',
        'destroy' => 'admin.criativos.destroy',
    ]);
});
