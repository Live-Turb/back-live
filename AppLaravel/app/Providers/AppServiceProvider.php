<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();
        
        // Adiciona função helper para obter cores com base na categoria
        if (!function_exists('getBadgeColor')) {
            function getBadgeColor($category) {
                $colors = [
                    'Marketing' => 'primary',
                    'Infraestrutura' => 'success',
                    'Pessoal' => 'danger',
                    'Operacional' => 'warning',
                    'Administrativo' => 'info',
                    'Tecnologia' => 'secondary',
                    'Outros' => 'dark'
                ];
                
                return $colors[$category] ?? 'secondary';
            }
        }
    }
}
