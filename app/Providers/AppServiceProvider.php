<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use App\Models\Ecole;
use App\Models\Parcour;
use App\Models\Concour;

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
            $view->with('parcours_egi', Parcour::where('ecole_id', 1)->get());
            $view->with('parcours_egmcs', Parcour::where('ecole_id', 2)->get());
            $view->with('parcours_egcn', Parcour::where('ecole_id', 3)->get());
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
