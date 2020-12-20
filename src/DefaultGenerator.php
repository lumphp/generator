<?php namespace Lum\Generator;

use Lum\Generator\Exceptions\FileAlreadyExistsException;
use Lum\Generator\Exceptions\FileNotFoundException;
use Lum\Generator\Templates\TemplateCompiler;
use Lum\Generator\Utils\FileSystemObject;

/**
 * Class DefaultGenerator
 *
 * @package Lum\Generator
 */
class DefaultGenerator implements Generator
{
    /**
     * @var FileSystemObject $fso
     */
    protected $fso;

    /**
     * @param FileSystemObject $fso
     */
    public function __construct(FileSystemObject $fso)
    {
        $this->fso = $fso;
    }

    /**
     * Run the generator
     *
     * @param string $templatePath
     * @param array $templateData
     * @param string $outputPath
     *
     * @throws FileAlreadyExistsException
     * @throws FileNotFoundException
     */
    public function generate(string $templatePath, array $templateData, string $outputPath)
    {
        $template = $this->compile($templatePath, $templateData, new TemplateCompiler);
        $this->fso->writeFileContent($outputPath, $template);
    }

    /**
     * Compile the file
     *
     * @param string $templatePath
     * @param array $data
     * @param TemplateCompiler $compiler
     *
     * @return string
     * @throws FileNotFoundException
     */
    public function compile(string $templatePath, array $data, TemplateCompiler $compiler) : string
    {
        return $compiler->compile($this->fso->getFileContent($templatePath), $data);
    }
}
