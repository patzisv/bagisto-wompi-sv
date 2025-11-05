<?php

namespace Kargo\WompiSV\Providers;

use Illuminate\Support\ServiceProvider;

class WompiSVServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../../config/wompisv.php', 'wompisv');

        // Binding del método de pago si Bagisto lo solicita vía contenedor
        $this->app->bind('payment.wompisv', fn () => new \Kargo\WompiSV\PaymentMethod\WompiSV);
    }

    public function boot(): void
    {
        // Rutas
        $this->loadRoutesFrom(__DIR__ . '/../../routes/web.php');

        // Publish config
        $this->publishes([
            __DIR__ . '/../../config/wompisv.php' => config_path('wompisv.php'),
        ], 'wompisv-config');

        // Inyectar método de pago en config de Bagisto
        $this->app['config']->set('payment_methods.wompisv', [
            'code'        => 'wompisv',
            'title'       => 'Wompi (El Salvador) 3DS',
            'description' => 'Tarjetas con 3-D Secure via Wompi SV',
            'class'       => \Kargo\WompiSV\PaymentMethod\WompiSV::class,
            'active'      => (bool) config('wompisv.enabled'),
            'sandbox'     => app()->environment('local') || config('wompisv.debug'),
            'sort'        => 5,
        ]);
    }
}