<?php

use App\Http\Controllers\ChatGptController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\DebugController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VideoController;
use Faker\Guesser\Name;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PayPalController;
use App\Http\Controllers\BuyPlanController;
use App\Http\Controllers\WebhookController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Middleware\RedirectIfNotRegistered;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CustomRegisterController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CurrentSubscriptionController;
use App\Http\Controllers\DetailsSuggestedVideoController;
use App\Http\Controllers\GenerateVideoController;
use App\Http\Controllers\StripeController;
use App\Http\Controllers\MercadoPagoController;
use App\Http\Middleware\ExpirationPlanDateCheckMiddleware;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\App;
use App\Http\Controllers\LocaleController;
use App\Http\Controllers\TestStripeController;
use App\Http\Controllers\BillingController;
use App\Http\Controllers\ViewAnalyticsController;
use App\Http\Controllers\ViewsAdjustController;
use App\Http\Controllers\BillingTestController;
use App\Http\Controllers\NextJsController;
use App\Http\Controllers\StorageDirectController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/createstoragelink', function () {

    $targetFolder = base_path() . '/storage/app/public';

    // $linkFolder = $_SERVER['DOCUMENT_ROOT'] . '/storage';
    $linkFolder = $_SERVER['DOCUMENT_ROOT'] . '/storage';
    // dd($targetFolder, $linkFolder);
    symlink($targetFolder, $linkFolder);
});
// Route::get('lang/change/{slug}',[LocaleController::class,'locale'])->name('lang.change');

// Route::get('/', [UserController::class, 'landingPage'])->name('landing'); // Rota original comentada
Route::redirect('/', 'https://app.liveturb.com'); // Redireciona a raiz para a aplicação Next.js em produção
Route::get('/home', [HomeController::class, 'index'])->name('home'); // Adicionando a rota home explicitamente
Route::get('/terms-of-use', [UserController::class, 'termsUse'])->name('termsUse');
Route::get('/privacy-policy', [UserController::class, 'privacyPolicy'])->name('privacyPolicy');
Route::get('locale/{locale}', function ($locale) {
    if (in_array($locale, ['en', 'pt'])) {
        session(['locale' => $locale]);
    }
    return redirect()->back();
});

// Rotas de registro e autenticação
Route::get('/user/register/{uuid}', [CustomRegisterController::class, 'registerForm'])->name('register.form');
Route::post('/register/{uuid}', [CustomRegisterController::class, 'userStore'])->name('user.store');

// Rotas de pagamento que não precisam de autenticação
Route::get('success-transaction', [PayPalController::class, 'successTransaction'])->name('successTransaction');
Route::get('cancel-transaction', [PayPalController::class, 'cancelTransaction'])->name('cancelTransaction');
Route::get('/success-transaction-stripe', [StripeController::class, 'successTransactionStripe'])->name('successTransactionStripe');
Route::get('/cancel-transaction-stripe', [StripeController::class, 'cancelTransactionStripe'])->name('cancelTransactionStripe');
Route::get('/mercadopago/success', [MercadoPagoController::class, 'successTransactionMercadoPago'])->name('mercadopago.success');
Route::get('/mercadopago/cancel', [MercadoPagoController::class, 'cancelTransactionMercadoPago'])->name('mercadopago.cancel');
Route::get('/failure-transaction-mercado-pago', [MercadoPagoController::class, 'failureTransactionMercadoPago'])->name('mercadopago.failure');

Auth::routes();

// Rota de login automático para ambiente de desenvolvimento
if (app()->environment('local')) {
    // Rota 1 - Login com ID 147 antoniojhuliene@gmail.com
    Route::get('/dev-login', function () {
        Auth::loginUsingId(147);
        return redirect('/analytics/dashboard');
    });

    // Rota 2 - Login com ID 1 Administrador
    Route::get('/dev-login-admin', function () {
        Auth::loginUsingId(1);
        return redirect('/admin/kpi');
    });
}

// Rotas sem autenticação
Route::post('generate/comment/ajax', [ChatGptController::class, 'generateCommentAjax'])->name('generate.comment.ajax');
Route::post('/write-debug-log', [DebugController::class, 'writeLog'])->name('debug.write');

// Account blocked route
Route::get('/account-blocked', function () {
    if (Auth::check() && Auth::user()->status != 'blocked') {
        return redirect('/dashboard');
    }
    return view('auth.account-blocked');
})->name('account.blocked');

Route::middleware(['auth', 'check.status'])->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::view('about', 'about')->name('about');
    Route::get('profile-management', [CurrentSubscriptionController::class, 'profileManagement'])->name('profileManagement');
    Route::get('my-broadcasts', [CurrentSubscriptionController::class, 'myBroadcasts'])->name('myBroadcasts');
    Route::get('comment-management', [CurrentSubscriptionController::class, 'commentManagement'])->name('commentManagement');
    Route::get('users', [\App\Http\Controllers\UserController::class, 'index'])->name('users.index');
    Route::get('profile', [\App\Http\Controllers\ProfileController::class, 'show'])->name('profile.show');
    Route::put('profile', [\App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');

    Route::put('/profile/update/{id}', [ProfileController::class, 'updateProfile'])->name('profile.update.user');

    Route::get('analytics/dashboard', [ViewAnalyticsController::class, 'dashboard'])->name('analytics.dashboard');
    Route::get('analytics/export', [ViewAnalyticsController::class, 'export'])->name('analytics.export');

    Route::post('generate/comment', [ChatGptController::class, 'generateComment'])->name('generate.comment');
    Route::post('generate/comment/input', [ChatGptController::class, 'generateCommentInput'])->name('generate.comment.input');
    Route::post('comment/{uuid}/store', [CommentController::class, 'store'])->name('comment.store');
    Route::get('comments/{uuid}', [CommentController::class, 'comments'])->name('comments.get');

    Route::get('video/{uuid}/view', [VideoController::class, 'edit'])->name('video.edit');
    Route::post('videothumb/{id}', [VideoController::class, 'update'])->name('thumb.update');
    Route::get('/subscription/cancel/{id}', [CurrentSubscriptionController::class, 'cancel'])->name('subscription.cancel');
    Route::post('/subscription/upgrade/{planUUID}/{userUUID}', [CurrentSubscriptionController::class, 'upgrade'])->name('subscription.upgrade');

    Route::get('/billing', [BillingController::class, 'index'])->name('billing.index');
    Route::post('/billing/create-charge', [BillingController::class, 'createCharge'])->name('billing.create-charge');
    Route::get('/billing/confirm', [BillingController::class, 'confirmPayment'])->name('billing.confirm');
    Route::post('/billing/{record}/process', [BillingController::class, 'processCharge'])->name('billing.process-charge');
    Route::get('/billing/{record}', [BillingController::class, 'show'])->name('billing.show');
    Route::get('/billing/views-chart', [BillingController::class, 'viewsChart'])->name('billing.views-chart');
    Route::get('/billing/invoices', [BillingController::class, 'invoices'])->name('billing.invoices');
    Route::get('/billing/invoices/{invoice}', [BillingController::class, 'invoice'])->name('billing.invoice');
    Route::get('/billing/invoices/{invoice}/download', [BillingController::class, 'downloadInvoice'])->name('billing.downloadInvoice');
    Route::get('/billing/invoices/{invoice}/cancel', [BillingController::class, 'cancelInvoice'])->name('billing.cancelInvoice');
    Route::get('/billing/invoices/{invoice}/update', [BillingController::class, 'updateInvoice'])->name('billing.updateInvoice');
    Route::get('/billing/invoices/{invoice}/delete', [BillingController::class, 'deleteInvoice'])->name('billing.deleteInvoice');

    // Rotas de Billing
    Route::prefix('billing')->name('billing.')->middleware(['auth'])->group(function () {
        Route::get('/', [BillingController::class, 'index'])->name('index');
        Route::get('/paid-views', [BillingController::class, 'paidViews'])->name('paidViews');
        Route::get('/payment', [BillingController::class, 'showPayment'])->name('payment');
        Route::get('/invoices', [BillingController::class, 'invoices'])->name('invoices');
        Route::get('/invoices/{invoice}', [BillingController::class, 'invoice'])->name('invoice');
        Route::get('/invoices/{invoice}/download', [BillingController::class, 'downloadInvoice'])->name('downloadInvoice');
    });

    // Rotas de teste para billing
    Route::prefix('billing-test')->group(function () {
        Route::get('/clear-history', [BillingTestController::class, 'clearBillingHistory'])->name('billing.test.clear-history');
    });

    Route::get('/support', function () {
        return view('support');
    })->name('support');

    Route::get('current-subscription', [CurrentSubscriptionController::class, 'currentSubscription'])->name('currentSubscription');

    // Paypal integration
    Route::get('create-transaction', [PayPalController::class, 'createTransaction'])->name('createTransaction');
    Route::post('process-transaction/{planUUID}/{userUUID}', [PayPalController::class, 'processTransaction'])->name('processTransaction');
    Route::get('proceed-to-continue', [PayPalController::class, 'processToContinue'])->name('processToContinue');

    Route::post('process-stripe-transaction/{planUUID}/{userUUID}', [StripeController::class, 'processStripeTransaction'])->name('processStripeTransaction');
    Route::post('/process-mercado-pago-transaction/{planUUID}/{userUUID}', [MercadoPagoController::class, 'processMercadoPagoTransaction'])->name('processMercadoPagoTransaction');

    Route::get('/abc',function(){
       dd('dd');
    });

    Route::get('test', function () {
        return "this is test route";
    })->name('test')->middleware('ExpirationPlanDateCheckMiddleware');

    // Rota de teste do Stripe
    Route::get('/test-stripe', [App\Http\Controllers\TestStripeController::class, 'testConnection'])
        ->name('test.stripe')
        ->middleware('auth');

    Route::post('add-video', [DetailsSuggestedVideoController::class, 'storeVideo'])->name('storeVideo');
    Route::put('video/{uuid}/update', [DetailsSuggestedVideoController::class, 'update'])->name('updateVideo');
    Route::get('delete/thumbnail/{id}', [DetailsSuggestedVideoController::class, 'deleteThumbnail'])->name('deleteThumbnail');

    Route::post('/store/thumbnail/img', [DetailsSuggestedVideoController::class, 'storefile'])->name('store.thumbnail.img');

    // Stripe Webhook
    Route::post('stripe/webhook', [App\Http\Controllers\StripeWebhookController::class, 'handleWebhook'])
        ->name('stripe.webhook')
        ->middleware('stripe.webhook');
});

// Rotas para ajuste de visualizações (remover em produção)
Route::prefix('views')->group(function () {
    Route::get('/reset/{email}', [ViewsAdjustController::class, 'resetViews']);
    Route::get('/set/{email}/{count}', [ViewsAdjustController::class, 'setViews']);
    Route::post('/adjust', [ViewsAdjustController::class, 'adjustViews']);
    Route::get('/billing/{email}', [ViewsAdjustController::class, 'checkBillingStatus']);
    Route::match(['get', 'post'], '/test-billing', [ViewsAdjustController::class, 'testBilling']);
    Route::get('/sync-billing/{email}', [ViewsAdjustController::class, 'syncBilling']);
    Route::get('/unblock/{email}', [ViewsAdjustController::class, 'unblockUser']);
});

// Rota pública para visualização de vídeos
Route::get('/genrate-video/{uuid}/view', [GenerateVideoController::class, 'generate'])
    ->name('video.view')
    ->middleware(['track.views']);

require __DIR__ . '/admin.php';

Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    // KPI Dashboard
    Route::get('/kpi', [App\Http\Controllers\Admin\KpiController::class, 'index'])->name('kpi.dashboard');
    Route::get('/kpi/api/total-users', [App\Http\Controllers\Admin\KpiController::class, 'getTotalUsers'])->name('kpi.api.total-users');
    Route::get('/kpi/api/total-revenue', [App\Http\Controllers\Admin\KpiController::class, 'getTotalRevenue'])->name('kpi.api.total-revenue');
    Route::get('/kpi/api/users-geographic', [App\Http\Controllers\Admin\KpiController::class, 'getUsersGeographicData'])->name('kpi.api.users-geographic');
    Route::get('/kpi/api/revenue', [App\Http\Controllers\Admin\KpiController::class, 'getRevenueData'])->name('kpi.api.revenue');
    Route::get('/kpi/api/session-time', [App\Http\Controllers\Admin\KpiController::class, 'getSessionTimeData'])->name('kpi.api.session-time');
    Route::get('/kpi/api/total-session-time', [App\Http\Controllers\Admin\KpiController::class, 'getTotalSessionTime'])->name('kpi.api.total-session-time');
    Route::get('/kpi/api/expenses', [App\Http\Controllers\Admin\KpiController::class, 'getExpensesData'])->name('kpi.api.expenses');
    Route::get('/kpi/api/cancellation-rate', [App\Http\Controllers\Admin\KpiController::class, 'getCancellationRateData'])->name('kpi.api.cancellation-rate');
    Route::get('/kpi/api/user-growth', [App\Http\Controllers\Admin\KpiController::class, 'getUserGrowthData'])->name('kpi.api.user-growth');
});

// Rota para criar anúncios de teste
Route::get('/admin/anuncios-teste', [App\Http\Controllers\Admin\AnuncioController::class, 'criarAnunciosTeste'])->name('admin.anuncios.teste');

// Rota para redirecionamento para Next.js removida, pois será tratada pelo frontend.

Route::post('/admin/anuncios/{id}/remover-imagem', [App\Http\Controllers\Admin\AnuncioController::class, 'removerImagem'])->name('admin.anuncios.remover-imagem');

// Rota para servir arquivos diretamente da pasta storage
Route::get('/storage_direct/{path}', [StorageDirectController::class, 'serve'])
    ->where('path', '.*')
    ->name('storage.direct');
