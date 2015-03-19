<?php namespace IqbalHakim\TwitterOuath1;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\ServiceProvider;
use IqbalHakim\TwitterOauth1\TwitterOauth1Manager;
use IqbalHakim\TwitterOauth1\TwitterOauth1Factory;

class TwitterOuath1ServiceProvider extends ServiceProvider {

  /**
   * Boot the service provider.
   *
   * @return void
   */
  public function boot()
  {
    $this->setupConfig();
  }

  /**
   * Setup the config.
   *
   * @return void
   */
  protected function setupConfig()
  {
    $source = realpath(__DIR__.'/config/twitter.php');
    $this->publishes([$source => config_path('twitter.php')]);
    $this->mergeConfigFrom($source, 'twitter');
  }

  /**
   * Register the service provider.
   *
   * @return void
   */
  public function register()
  {
    $this->registerFactory($this->app);
    $this->registerManager($this->app);
  }

  /**
   * Register the factory class.
   *
   * @param \Illuminate\Contracts\Foundation\Application $app
   *
   * @return void
   */
  protected function registerFactory(Application $app)
  {
    $app->singleton('twitter.factory', function()
    {
      return new TwitterOauth1Factory();
    });
    $app->alias('twitter.factory', 'IqbalHakim\TwitterOauth1\Factories\TwitterOauth1Factory');
  }

  /**
   * Register the manager class.
   *
   * @param \Illuminate\Contracts\Foundation\Application $app
   *
   * @return void
   */
  protected function registerManager(Application $app)
  {
    $app->singleton('twitter', function($app)
    {
      $config = $app['config'];
      // print '<pre>';
      // var_dump($config);
      $factory = $app['twitter.factory'];

      return new TwitterOauth1Manager($config, $factory);
    });

    $app->alias('twitter', 'IqbalHakim\TwitterOauth1\TwitterOauth1Manager');
  }

  /**
   * Get the services provided by the provider.
   *
   * @return string[]
   */
  public function provides()
  {
    return [
      'twitter',
      'twitter.factory'
    ];
  }

}
