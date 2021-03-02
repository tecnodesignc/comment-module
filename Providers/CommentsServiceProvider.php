<?php

namespace Modules\Comments\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Core\Traits\CanPublishConfiguration;
use Modules\Core\Events\BuildingSidebar;
use Modules\Core\Events\LoadingBackendTranslations;
use Modules\Comments\Events\Handlers\RegisterCommentsSidebar;
use Illuminate\Support\Arr;

class CommentsServiceProvider extends ServiceProvider
{
    use CanPublishConfiguration;
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerBindings();
        $this->app['events']->listen(BuildingSidebar::class, RegisterCommentsSidebar::class);

        $this->app['events']->listen(LoadingBackendTranslations::class, function (LoadingBackendTranslations $event) {
            $event->load('comments', Arr::dot(trans('comments::comments')));
            // append translations

        });
    }

    public function boot()
    {
        $this->publishConfig('comments', 'permissions');

        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array();
    }

    private function registerBindings()
    {
        $this->app->bind(
            'Modules\Comments\Repositories\CommentRepository',
            function () {
                $repository = new \Modules\Comments\Repositories\Eloquent\EloquentCommentRepository(new \Modules\Comments\Entities\Comment());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Comments\Repositories\Cache\CacheCommentDecorator($repository);
            }
        );
// add bindings

    }
}
