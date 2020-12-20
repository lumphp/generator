<?php namespace Lum\Generator\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Symfony\Component\Console\Input\InputArgument;

/**
 * Class MvcGeneratorCommand
 *
 * @package Lum\Generator\Commands
 */
class MvcGeneratorCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'generate:mvc';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate a mvc resources';

    /**
     * Generate a resource
     */
    public function handle()
    {
        $resource = $this->argument('resource');
        $this->callModel($resource);
        $this->callView($resource);
        $this->callController($resource);
        $this->info(
            sprintf(
                "All done! Don't forget to add `%s` to %s.".PHP_EOL,
                "Route::resource('{$this->getTableName($resource)}', '{$this->getControllerName($resource)}');",
                "app/routes.php"
            )
        );
    }

    /**
     * Get the name for the model
     *
     * @param string $resource
     *
     * @return string
     */
    protected function getModelName(string $resource) : string
    {
        return ucwords(Str::camel($resource));
    }

    /**
     * Get the name for the controller
     *
     * @param $resource
     *
     * @return string
     */
    protected function getControllerName(string $resource) : string
    {
        return ucwords(Str::camel($resource));
    }

    /**
     * Get the DB table name
     *
     * @param $resource
     *
     * @return string
     */
    protected function getTableName(string $resource) : string
    {
        return Str::snake($resource);
    }

    /**
     * Call model generator if user confirms
     *
     * @param $resource
     */
    protected function callModel(string $resource)
    {
        $modelName = $this->getModelName($resource);
        if ($this->confirm("Do you want me to create a $modelName model? [yes|no]")) {
            $this->call('generate:model', compact('modelName'));
        }
    }

    /**
     * Call view generator if user confirms
     *
     * @param $resource
     */
    protected function callView(string $resource)
    {
        $collection = $this->getTableName($resource);
        $modelName = $this->getModelName($resource);
        if ($this->confirm("Do you want me to create views for this $modelName resource? [yes|no]")) {
            foreach (['index', 'show', 'create', 'edit'] as $viewName) {
                $viewName = "{$collection}.{$viewName}";
                $this->call('generate:view', compact('viewName'));
            }
        }
    }

    /**
     * Call controller generator if user confirms
     *
     * @param $resource
     */
    protected function callController(string $resource)
    {
        $controllerName = $this->getControllerName($resource);
        if ($this->confirm("Do you want me to create a $controllerName controller? [yes|no]")) {
            $this->call('generate:controller', compact('controllerName'));
        }
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        $args = parent::getArguments();

        return array_merge(
            $args,
            [
                ['resource', InputArgument::REQUIRED, 'Singular resource name'],
            ]
        );
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions() : array
    {
        $options = parent::getOptions();

        return array_merge(
            $options,
            []
        );
    }

}
