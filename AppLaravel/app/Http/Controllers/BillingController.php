<?php

namespace App\Http\Controllers;

use App\Models\ViewBillingRecord;
use App\Services\ViewTrackingService;
use App\Services\StripeChargeService;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Models\Subscription;

class BillingController extends Controller
{
    protected $viewTrackingService;
    protected $stripeChargeService;

    public function __construct(
        ViewTrackingService $viewTrackingService,
        StripeChargeService $stripeChargeService
    ) {
        $this->viewTrackingService = $viewTrackingService;
        $this->stripeChargeService = $stripeChargeService;
        $this->middleware('auth')->except('confirmPayment');
        $this->middleware(function ($request, $next) {
            if ($request->ajax() || $request->wantsJson()) {
                return $next($request);
            }
            
            if ($request->is('billing/paid-views')) {
                return response()->json([
                    'success' => false,
                    'message' => 'Esta rota só pode ser acessada via AJAX'
                ], 400);
            }
            
            return $next($request);
        })->only('paidViews');
    }

    /**
     * Mostra a página principal de cobranças com histórico
     */
    public function index(Request $request)
    {
        try {
            $userId = Auth::id();
            $viewTrackingService = app(ViewTrackingService::class);

            // Obtém os registros de cobrança
            $billingRecords = ViewBillingRecord::where('user_id', $userId)
                ->orderBy('created_at', 'desc')
                ->paginate(10);

            // Obtém a assinatura atual e o plano
            $subscription = Subscription::where('user_id', $userId)
                ->where('status', 'ACTIVE')
                ->with('paypalPlan')
                ->first();

            // Calcula total de visualizações pagas
            $totalPaidViews = ViewBillingRecord::where('user_id', $userId)
                ->where('status', 'processed')
                ->sum('extra_views');

            // Obtém informações do plano atual
            $planViewsLimit = $viewTrackingService->getUserPlanViewsLimit($userId);
            $planName = $subscription && $subscription->paypalPlan ? $subscription->paypalPlan->name : 'Basic';

            $viewsInfo = [
                'total_views' => $viewTrackingService->getCurrentViews($userId),
                'plan_views_limit' => $planViewsLimit,
                'plan_name' => $planName,
                'has_subscription' => !is_null($subscription),
                'extra_view_cost' => ViewTrackingService::EXTRA_VIEW_COST,
                'total_paid_views' => $totalPaidViews
            ];

            $viewsInfo['extra_views'] = max(0, $viewsInfo['total_views'] - $viewsInfo['plan_views_limit']);
            $viewsInfo['extra_cost'] = $viewsInfo['extra_views'] * $viewsInfo['extra_view_cost'];
            $viewsInfo['remaining_views'] = max(0, $viewsInfo['plan_views_limit'] - $viewsInfo['total_views']);
            $viewsInfo['show_payment_button'] = $viewsInfo['extra_views'] > 0;

            return view('billing.index', compact('viewsInfo', 'billingRecords'));

        } catch (\Exception $e) {
            Log::error('Erro ao carregar página de billing:', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return redirect()->back()->with('error', 'Erro ao carregar informações de billing. Por favor, tente novamente.');
        }
    }

    /**
     * Mostra o histórico detalhado de cobranças
     */
    public function history(Request $request)
    {
        $userId = auth()->id();
        
        // Define o período
        $startDate = $request->filled('start_date') 
            ? Carbon::parse($request->start_date)->startOfDay()
            : Carbon::now()->startOfMonth();
            
        $endDate = $request->filled('end_date')
            ? Carbon::parse($request->end_date)->endOfDay()
            : Carbon::now()->endOfDay();

        // Busca registros de cobrança
        $billingRecords = ViewBillingRecord::where('user_id', $userId)
            ->whereBetween('created_at', [$startDate, $endDate])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        // Calcula resumo do período
        $summary = [
            'total_views' => ViewBillingRecord::where('user_id', $userId)
                ->whereBetween('created_at', [$startDate, $endDate])
                ->sum('total_views'),
            'total_extra_views' => ViewBillingRecord::where('user_id', $userId)
                ->whereBetween('created_at', [$startDate, $endDate])
                ->sum('extra_views'),
            'total_cost' => ViewBillingRecord::where('user_id', $userId)
                ->whereBetween('created_at', [$startDate, $endDate])
                ->sum('extra_views_cost')
        ];

        return view('billing.history', compact('billingRecords', 'startDate', 'endDate', 'summary'));
    }

    /**
     * Mostra detalhes de uma cobrança específica
     */
    public function show(ViewBillingRecord $record)
    {
        $this->authorize('view', $record);

        return view('billing.show', compact('record'));
    }

    /**
     * Processa manualmente uma cobrança pendente
     */
    public function processCharge(ViewBillingRecord $record)
    {
        $this->authorize('update', $record);

        if ($record->status !== 'pending') {
            return response()->json([
                'success' => false,
                'error' => 'Esta cobrança não está pendente.'
            ]);
        }

        try {
            Log::info('Iniciando processamento de cobrança:', [
                'record_id' => $record->id,
                'user_id' => $record->user_id,
                'amount' => $record->extra_views_cost
            ]);

            $chargeResult = $this->stripeChargeService->createExtraViewsCharge($record);

            Log::info('Resultado do processamento:', $chargeResult);

            return response()->json($chargeResult);

        } catch (\Exception $e) {
            Log::error('Erro ao processar cobrança:', [
                'record_id' => $record->id,
                'error' => $e->getMessage()
            ]);

            return response()->json([
                'success' => false,
                'error' => 'Erro ao processar a cobrança: ' . $e->getMessage()
            ]);
        }
    }

    /**
     * Confirma o pagamento e atualiza o status do registro
     */
    public function confirmPayment(Request $request)
    {
        try {
            $stripe = new \Stripe\StripeClient(config('services.stripe.secret'));
            
            // Recupera o payment_intent do Stripe
            $paymentIntent = $stripe->paymentIntents->retrieve(
                $request->payment_intent
            );

            if ($paymentIntent->status === 'succeeded') {
                // Atualiza o registro de cobrança
                $billingRecordId = $paymentIntent->metadata->billing_record_id;
                
                $billingRecord = ViewBillingRecord::findOrFail($billingRecordId);
                $billingRecord->update([
                    'status' => 'processed',
                    'stripe_payment_id' => $paymentIntent->id,
                    'processed_at' => now()
                ]);

                return redirect()->route('billing.index')->with('success', 'Pagamento processado com sucesso!');
            }

            return redirect()->route('billing.index')->with('error', 'Erro ao processar o pagamento. Por favor, tente novamente.');

        } catch (\Exception $e) {
            Log::error('Erro ao confirmar pagamento: ' . $e->getMessage());
            return redirect()->route('billing.index')->with('error', 'Erro ao confirmar o pagamento: ' . $e->getMessage());
        }
    }

    /**
     * Cria um novo registro de cobrança e inicia o processo de pagamento
     */
    public function createCharge(Request $request)
    {
        try {
            $userId = Auth::id();
            $extraViews = $request->input('extra_views');
            $extraCost = $request->input('extra_cost');

            // Verifica se já existe um pagamento para o período atual
            $currentMonth = now()->month;
            $currentYear = now()->year;
            $startOfMonth = now()->startOfMonth();
            $endOfMonth = now()->endOfMonth();
            
            $existingPaid = ViewBillingRecord::where('user_id', $userId)
                ->whereMonth('billing_period_start', $currentMonth)
                ->whereYear('billing_period_start', $currentYear)
                ->where('status', 'processed')
                ->exists();

            if ($existingPaid) {
                return response()->json([
                    'success' => false,
                    'error' => 'Já existe um pagamento processado para este período.'
                ]);
            }

            // Verifica se já existe um registro pendente e atualiza ao invés de criar novo
            $pendingRecord = ViewBillingRecord::where('user_id', $userId)
                ->whereMonth('billing_period_start', $currentMonth)
                ->whereYear('billing_period_start', $currentYear)
                ->where('status', 'pending')
                ->first();

            if ($pendingRecord) {
                $pendingRecord->update([
                    'total_views' => $extraViews,
                    'extra_views' => $extraViews,
                    'extra_views_cost' => $extraCost,
                    'billing_period_start' => $startOfMonth,
                    'billing_period_end' => $endOfMonth
                ]);
                $billingRecord = $pendingRecord;
            } else {
                // Cria um novo registro de cobrança
                $billingRecord = ViewBillingRecord::create([
                    'user_id' => $userId,
                    'billing_period_start' => $startOfMonth,
                    'billing_period_end' => $endOfMonth,
                    'total_views' => $extraViews,
                    'extra_views' => $extraViews,
                    'extra_views_cost' => $extraCost,
                    'status' => 'pending'
                ]);
            }

            // Cria a intenção de pagamento no Stripe
            $stripe = new \Stripe\StripeClient(config('services.stripe.secret'));
            
            $paymentIntent = $stripe->paymentIntents->create([
                'amount' => $extraCost * 100, // Stripe trabalha com centavos
                'currency' => 'brl',
                'automatic_payment_methods' => [
                    'enabled' => true,
                ],
                'metadata' => [
                    'billing_record_id' => $billingRecord->id
                ]
            ]);

            return response()->json([
                'success' => true,
                'client_secret' => $paymentIntent->client_secret
            ]);

        } catch (\Exception $e) {
            Log::error('Erro ao criar cobrança: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'error' => 'Erro ao criar cobrança: ' . $e->getMessage()
            ]);
        }
    }

    /**
     * Retorna dados para o gráfico de visualizações
     */
    public function viewsChart(Request $request)
    {
        $user = auth()->user();
        $days = $request->get('days', 30);
        $endDate = Carbon::now();
        $startDate = $endDate->copy()->subDays($days);

        $views = \App\Models\TemplateView::where('user_id', $user->id)
            ->whereBetween('created_at', [$startDate, $endDate])
            ->selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        $labels = [];
        $data = [];

        // Preenche dados para todos os dias
        for ($date = $startDate->copy(); $date <= $endDate; $date->addDay()) {
            $dateStr = $date->format('Y-m-d');
            $labels[] = $date->format('d/m');
            $viewCount = $views->firstWhere('date', $dateStr);
            $data[] = $viewCount ? $viewCount->count : 0;
        }

        return response()->json([
            'labels' => $labels,
            'data' => $data
        ]);
    }

    /**
     * Mostra informações de pagamento
     */
    public function showPayment()
    {
        $user = auth()->user();
        
        // Busca cobranças pendentes
        $pendingCharges = ViewBillingRecord::where('user_id', $user->id)
            ->where('status', 'pending')
            ->get();

        // Calcula totais
        $totalAmount = $pendingCharges->sum('extra_views_cost');
        $totalExtraViews = $pendingCharges->sum('extra_views');

        // Busca visualizações do mês
        $currentMonthViews = ViewStatistic::where('user_id', $user->id)
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();

        return view('billing.payment', [
            'user' => $user,
            'pending_charges' => $pendingCharges,
            'total_amount' => $totalAmount,
            'total_extra_views' => $totalExtraViews,
            'current_month_views' => $currentMonthViews,
            'basic_plan_views' => 6000
        ]);
    }

    /**
     * Retorna os detalhes das visualizações pagas
     */
    public function paidViews(Request $request)
    {
        try {
            $userId = Auth::id();
            $recordId = $request->input('record_id');
            
            $query = ViewBillingRecord::where('user_id', $userId)
                ->where('status', 'processed');

            // Se um ID específico foi fornecido, busca apenas esse registro
            if ($recordId) {
                $query->where('id', $recordId);
            }

            $paidRecords = $query->orderBy('created_at', 'desc')->get();

            // Calcula usando amount quando disponível, caso contrário usa extra_views_cost
            $totalPaidViews = $paidRecords->sum('total_views');
            $totalPaidAmount = $paidRecords->sum(function($record) {
                return $record->amount ?? $record->extra_views_cost;
            });

            $records = $paidRecords->map(function ($record) {
                return [
                    'id' => $record->id,
                    'date' => $record->paid_at ? $record->paid_at->toISOString() : ($record->created_at ? $record->created_at->toISOString() : null),
                    'billing_period_start' => $record->billing_period_start ? $record->billing_period_start->toISOString() : null,
                    'billing_period_end' => $record->billing_period_end ? $record->billing_period_end->toISOString() : null,
                    'views' => (int)($record->total_views ?? $record->extra_views),
                    'amount' => (float)($record->amount ?? $record->extra_views_cost),
                    'description' => $record->description ?? __('billing.extra_views_payment'),
                    'status' => $record->status
                ];
            })->filter();

            return response()->json([
                'success' => true,
                'data' => [
                    'records' => $records->values(),
                    'total_views' => $totalPaidViews,
                    'total_amount' => $totalPaidAmount
                ]
            ]);

        } catch (\Exception $e) {
            Log::error('Erro ao buscar visualizações pagas:', [
                'user_id' => $userId ?? null,
                'record_id' => $recordId ?? null,
                'error' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Erro ao buscar visualizações pagas: ' . $e->getMessage()
            ], 500);
        }
    }
}
