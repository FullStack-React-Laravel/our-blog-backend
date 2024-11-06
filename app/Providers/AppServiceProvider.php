<?php

namespace App\Providers;

use App\Models\Post;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        Model::preventLazyLoading($this->app->runningUnitTests());
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        \Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::except([
            '*'
        ]);

        ResetPassword::createUrlUsing(function (object $notifiable, string $token) {
            return config('app.frontend_url') . "/password-reset/$token?email={$notifiable->getEmailForPasswordReset()}";
        });

        //be aware that the 'post' variable must be matched (in name) with $post variable in PostController.show [ex : show(App\Models\Post $post)] 
        Route::bind('post', function ($val) {
            return Post::where('slug', $val)->firstOrFail();
        });
    }
}
