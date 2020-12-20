<?php namespace Lum\Generator\Commands;

use Illuminate\Support\Facades\File;
use Symfony\Component\Console\Input\InputArgument;

/**
 * Class ViewAbstractGeneratorCommand
 *
 * @package Lum\Generator\Commands
 */
class ViewGeneratorCommand extends AbstractGeneratorCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'generate:view';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate a view';

    /**
     * Create directory tree for views, and fire the generator.
     */
    public function handle()
    {
        $directoryPath = dirname($this->getOutputPath());
        if (!File::exists($directoryPath)) {
            File::makeDirectory($directoryPath, 0777, true);
        }
        parent::handle();
    }

    /**
     * The path to where the file will be created.
     *
     * @return mixed
     */
    protected function getOutputPath()
    {
        $path = $this->getPathByOptionOrConfig('path', 'view_target_path');
        $viewName = str_replace('.', '/', $this->argument('viewName'));

        return sprintf('%s/%s.blade.php', $path, $viewName);
    }

    /**
     * Fetch the template data.
     *
     * @return array
     */
    protected function getTemplateData() : array
    {
        return [
            'PATH' => $this->getOutputPath(),
        ];
    }

    /**
     * Get the path to the template for the generator.
     *
     * @return mixed
     */
    protected function getTemplatePath()
    {
        return $this->getPathByOptionOrConfig('templatePath', 'view_template_path');
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
                ['viewName', InputArgument::REQUIRED, 'The name of the desired view'],
            ]
        );
    }
}
