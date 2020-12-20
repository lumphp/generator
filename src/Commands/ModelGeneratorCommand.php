<?php namespace Lum\Generator\Commands;

use Illuminate\Support\Str;
use Symfony\Component\Console\Input\InputArgument;

/**
 * Class ModelAbstractGeneratorCommand
 *
 * @package Generator\Commands
 */
class ModelGeneratorCommand extends AbstractGeneratorCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'generate:model';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate a model';
    /**
     * @var string
     */
    protected $modelName = '';

    protected function init()
    {
        $argModelName = $this->argument('modelName');
        $this->modelName = str_replace('_', '', ucwords(Str::camel($argModelName)));
    }

    /**
     * The path to where the file will be created.
     *
     * @return mixed
     */
    protected function getOutputPath()
    {
        $this->init();
        $path = $this->getPathByOptionOrConfig('path', 'model_target_path');

        return $path.'/'.$this->modelName.'.php';
    }

    /**
     * Fetch the template data.
     *
     * @return array
     */
    protected function getTemplateData()
    {
        $this->init();

        return [
            'NAME' => $this->modelName,
            'NAMESPACE' => 'App',
            'TABLE' => Str::snake($this->argument('modelName')),
        ];
    }

    /**
     * Get path to the template for the generator.
     *
     * @return mixed
     */
    protected function getTemplatePath()
    {
        return $this->getPathByOptionOrConfig('templatePath', 'model_template_path');
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
                ['modelName', InputArgument::REQUIRED, 'The name of the desired Eloquent model'],
            ]
        );
    }
}
