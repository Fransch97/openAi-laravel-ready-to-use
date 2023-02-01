<?php

namespace App\Providers;

use App\Classes\Gpt\ClientGpt;
use Illuminate\Support\ServiceProvider;

class GptServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('gpt', function($app){
            return new ClientGpt(
                config('services.gpt.secret'),
                config('services.gpt.model'),
                config('services.gpt.temperature'),
                config('services.gpt.max_tokens'),
                config('services.gpt.frequency_penalty'),
                config('services.gpt.presence_penalty'),
            );
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
    }
}
