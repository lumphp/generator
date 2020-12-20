<?php namespace Lum\Generator\Commands;

use Lum\Generator\Templates\TemplateData;
use Symfony\Component\Console\Input\InputArgument;

/**
 * Class ControllerGeneratorCommand
 *
 * @package Lum\Generator\Commands
 */
class ControllerGeneratorCommand extends AbstractGeneratorCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'generate:controller';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate a controller';

    /**
     * Get the path to the template for the generator.
     *
     * @return mixed
     */
    protected function getTemplatePath() : string
    {
        return $this->getPathByOptionOrConfig('templatePath', 'controller_template_path');
    }

    /**
     * Fetch the template data.
     *
     * @return array
     */
    protected function getTemplateData() : array
    {
        return (new TemplateData($this->argument('controllerName')))->fetch();
    }

    /**
     * The path to where the file will be created.
     *
     * @return mixed
     */
    protected function getOutputPath() : string
    {
        $path = $this->getPathByOptionOrConfig('path', 'controller_target_path');

        return sprintf('%s/%s.php', $path, $this->getControllerName());
    }

    /**
     * @return string
     */
    protected function getControllerName() : string
    {
        return sprintf('%sController', $this->argument('controllerName'));
    }

    /**
     * Get the console command arguments.
     *
     * @return array|array[]
     */
    protected function getArguments() : array
    {
        $args = parent::getArguments();

        return array_merge(
            $args,
            [
                ['controllerName', InputArgument::REQUIRED, 'The name of the desired controller.'],
            ]
        );
    }
}
