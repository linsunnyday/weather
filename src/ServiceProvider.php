<?php

namespace Linsunnyday\Weather;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    // 延迟注册方式
    protected $defer = true;

    public function register()
    {
        $this->app->singleton(Weather::class, function () {
            return new Weather(config('services.weather.key'));
        });

        $this->app->alias(Weather::class, 'weather');
    }

    /**
     * Laravel 扩展包的延迟注册方式，它不会在框架启动就注册，而是当你调用到它的时候才会注册.
     *
     * @return [type] [description]
     */
    public function provides()
    {
        return [Weather::class, 'weather'];
    }
}
