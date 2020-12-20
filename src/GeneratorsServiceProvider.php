<?php
namespace Lum\Generator;

use Illuminate\Support\ServiceProvider;
use Lum\Generator\Commands\ControllerGeneratorCommand;
use Lum\Generator\Commands\ModelGeneratorCommand;
use Lum\Generator\Commands\MvcGeneratorCommand;
use Lum\Generator\Commands\ViewGeneratorCommand;

/**
 * Class GeneratorsServiceProvider
 *
 * @package Generator
 */
class GeneratorsServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Booting
     */
    public function boot()
    {
        $this->publishes(
            [
                realpath(__DIR__.'/../config/config.php') => base_path('generator.config.php'),
            ]
        );
    }

    /**
     * Register the commands
     */
    public function register()
    {
        parent::register();
        $this->registerConfig();
        foreach ([
            'Model',
            'View',
            'Controller',
            'Mvc',
        ] as $command) {
            $methodName = sprintf('register%s', $command);
            $this->$methodName();
        }
    }

    /**
     * Register the model generator
     */
    protected function registerModel()
    {
        $this->app->singleton(
            'generate.model',
            function ($app) {
                $generator = $this->app->make('\Generator\Generators\DefaultGenerator');

                return new ModelGeneratorCommand($generator);
            }
        );
        $this->commands('generate.model');
    }

    /**
     * Register the config paths
     */
    public function registerConfig()
    {
        $userConfigFile = $this->app->configPath().'/generators.config.php';
        $packageConfigFile = realpath(__DIR__.'/../config/config.php');
        $config = $this->app['files']->getRequire($packageConfigFile);
        if (file_exists($userConfigFile)) {
            $userConfig = $this->app['files']->getRequire($userConfigFile);
            $config = array_replace_recursive($config, $userConfig);
        }
        $this->app['config']->set('generator.config', $config);
    }

    /**
     * Register the view generator
     */
    protected function registerView()
    {
        $this->app->singleton(
            'generate.view',
            function ($app) {
                $generator = $this->app->make('\Lum\Generator\DefaultGenerator');

                return new ViewGeneratorCommand($generator);
            }
        );
        $this->commands('generate.view');
    }

    /**
     * Register the controller generator
     */
    protected function registerController()
    {
        $this->app->singleton(
            'generate.controller',
            function ($app) {
                $generator = $this->app->make('\Lum\Generator\DefaultGenerator');

                return new ControllerGeneratorCommand($generator);
            }
        );
        $this->commands('generate.controller');
    }

    /**
     * Register the rest generator
     */
    protected function registerMvc()
    {
        $this->app->singleton(
            'generate.mvc',
            function ($app) {
                return new MvcGeneratorCommand;
            }
        );
        $this->commands('generate.mvc');
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        $provides = parent::provides();

        return array_merge($provides, []);
    }
}
