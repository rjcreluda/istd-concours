<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use App\Models\Ecole;
use App\Models\Parcour;
use App\Models\Concour;
use App\Repositories\ParcoursRepository;

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
        Blade::directive('format_note', function ($money) {
            return "<?php echo number_format($money, 2, ',', '.'); ?>";
        });
        Blade::directive('format_date', function ($date) {
            return "<?php echo ($date)->format('d/m/Y H:i'); ?>";
        });
        view()->composer('layouts.sidebar', function($view) {
            $view->with('ecoles', Ecole::all());
            $view->with('parcours_egi', ParcoursRepository::getParcoursByCycle(1, 'EGI'));
            $view->with('parcours_egmcs', ParcoursRepository::getParcoursByCycle(1, 'EGMCS'));
            $view->with('parcours_egcn', ParcoursRepository::getParcoursByCycle(1, 'EGCN'));
        });
        Blade::if('admin', function(){
            return auth()->user()->type == 'admin';
        });
        Blade::if('admin_controlleur', function(){
            return auth()->user()->type == 'admin' || auth()->user()->type == 'controlleur' ;
        });
        view()->share('concour_active', Concour::active()->get()->first() );
    }
}
