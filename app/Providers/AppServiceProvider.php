<?php

namespace App\Providers;

use App\Models\Order;
use App\Observers\OrderObserver;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::directive('linkIsActive', function ($routeName) {
            return "<?php echo request()->route()->getName() == $routeName ? 'active' : null; ?>";
        });


        Blade::directive('orderLabel', function ($orderStatus) {
            return '<span class="label label-default">{{\App\Enums\OrderStatus::getDescription(' . $orderStatus . ')}}</span>';
        });

        Order::observe(OrderObserver::class);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
