<?php namespace Lum\Generator\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Config;
use Lum\Generator\Generator;
use Symfony\Component\Console\Input\InputOption;

/**
 * Class AbstractGeneratorCommand
 *
 * @package Lum\Generator\Commands
 */
abstract class AbstractGeneratorCommand extends Command
{
    /**
     * The AbstractGeneratorCommand instance.
     *
     * @var Generator
     */
    protected $generator;

    /**
     * Create a new GeneratorCommand instance.
     *
     * @param Generator $generator
     */
    public function __construct(Generator $generator)
    {
        $this->generator = $generator;
        parent::__construct();
    }

    /**
     * Fetch the template data.
     *
     * @return array
     */
    protected abstract function getTemplateData();

    /**
     * The path to where the file will be created.
     *
     * @return string
     */
    protected abstract function getOutputPath();

    /**
     * Get the path to the generator template.
     *
     * @return string
     */
    protected abstract function getTemplatePath();

    /**
     * Compile and generate the file.
     */
    public function handle()
    {
        $outputPath = $this->getOutputPath();
        $this->generator->generate(
            $this->getTemplatePath(),
            $this->getTemplateData(),
            $outputPath
        );
        $this->info("Created: {$outputPath}");
    }

    /**
     * Get a directory path through a command option, or from the configuration.
     *
     * @param $option
     * @param $configName
     *
     * @return string
     */
    protected function getPathByOptionOrConfig($option, $configName) : string
    {
        if ($path = $this->option($option)) {
            return $path;
        }

        return Config::get("generator.config.{$configName}");
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
            [
                ['path', null, InputOption::VALUE_REQUIRED, 'Where should the file be created?'],
                [
                    'templatePath',
                    null,
                    InputOption::VALUE_REQUIRED,
                    'The location of the template for this generator',
                ],
            ]
        );
    }
}
