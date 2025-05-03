<?php

namespace App\Http\Controllers\Analytics;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TemplateView;
use App\Models\Template;
use Carbon\Carbon;

class ViewsController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $viewsLimit = $user->subscription->views_limit;
        $viewsUsed = TemplateView::where('user_id', $user->id)
            ->whereMonth('created_at', Carbon::now()->month)
            ->count();
        
        $extraViews = max(0, $viewsUsed - $viewsLimit);
        $extraCost = $extraViews * 0.02; // R$ 0,02 por visualização extra
        
        // Dados para o gráfico
        $chartData = $this->getChartData();
        
        // Templates mais visualizados
        $topTemplates = Template::where('user_id', $user->id)
            ->withCount(['views' => function($query) {
                $query->whereMonth('created_at', Carbon::now()->month);
            }])
            ->orderByDesc('views_count')
            ->limit(5)
            ->get();
        
        // Histórico de visualizações
        $viewsHistory = TemplateView::where('user_id', $user->id)
            ->with('template')
            ->orderByDesc('created_at')
            ->get()
            ->groupBy(function($date) {
                return Carbon::parse($date->created_at)->format('Y-m-d');
            })
            ->map(function($group) use ($viewsLimit) {
                $count = $group->count();
                return (object)[
                    'date' => Carbon::parse($group->first()->created_at),
                    'template_name' => $group->first()->template->name,
                    'views_count' => $count,
                    'is_extra' => $count > $viewsLimit
                ];
            });
        
        return view('analytics.views', compact(
            'viewsUsed',
            'viewsLimit',
            'extraViews',
            'extraCost',
            'chartData',
            'topTemplates',
            'viewsHistory'
        ));
    }
    
    private function getChartData()
    {
        $user = auth()->user();
        $days = collect(range(0, 29))->map(function($day) {
            return Carbon::now()->subDays($day);
        })->reverse();
        
        $views = TemplateView::where('user_id', $user->id)
            ->whereDate('created_at', '>=', $days->first())
            ->whereDate('created_at', '<=', $days->last())
            ->get()
            ->groupBy(function($view) {
                return $view->created_at->format('Y-m-d');
            });
        
        return [
            'labels' => $days->map(function($day) {
                return $day->format('d/m');
            })->toArray(),
            'data' => $days->map(function($day) use ($views) {
                $date = $day->format('Y-m-d');
                return $views->get($date, collect())->count();
            })->toArray()
        ];
    }
}
