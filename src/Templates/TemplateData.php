<?php namespace Lum\Generator\Templates;

use Illuminate\Support\Str;

/**
 * Class TemplateData
 *
 * @package Lum\Generator\Templates
 */
class TemplateData
{
    /**
     * The name of the controller to generate.
     *
     * @var string
     */
    private $controllerName;

    /**
     * Create a new Controller template data instance.
     *
     * @param $controllerName
     */
    public function __construct(string $controllerName)
    {
        $this->controllerName = $controllerName;
    }

    /**
     * Fetch the template data for the controller.
     *
     * @return array
     */
    public function fetch() : array
    {
        return [
            'name' => $this->getName(),
            'collection' => $this->getCollection(),
            'resource' => $this->getResource(),
            'model' => $this->getModel(),
            'namespace' => $this->getNamespace(),
            'base_namespace' => $this->getBaseNamespace(),
        ];
    }

    /**
     * Format the name of the controller.
     *
     * @return string
     */
    private function getName() : string
    {
        return ucwords($this->controllerName);
    }

    /**
     * Format the name of the collection.
     *
     * @return string
     */
    private function getCollection() : string
    {
        return strtolower(str_replace('Controller', '', $this->getName()));
    }

    /**
     * Format the name of the single resource.
     *
     * @return string
     */
    private function getResource() : string
    {
        return Str::singular($this->getCollection());
    }

    /**
     * Format the name of the model.
     *
     * @return string
     */
    private function getModel() : string
    {
        return ucwords($this->getResource());
    }

    /**
     * Format the name of the namespace.
     *
     * @return string
     */
    public function getBaseNamespace() : string
    {
        return 'App';
    }

    /**
     * Format the name of the namespace.
     *
     * @return string
     */
    public function getNamespace() : string
    {
        return sprintf('%s\Http\Controllers', $this->getBaseNamespace());
    }
}
