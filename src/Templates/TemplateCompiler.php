<?php namespace Lum\Generator\Templates;

/**
 * Class TemplateCompiler
 *
 * @package Lum\Generator\Compilers
 */
class TemplateCompiler implements Compiler
{
    private const PATTERN_FORMAT = "/\\$%s\\$/i";

    /**
     * Compile the template
     *
     * @param string $template
     * @param array $data
     *
     * @return string
     */
    public function compile(string $template, array $data) : string
    {
        $content = $template;
        foreach ($data as $key => $value) {
            $content = preg_replace(sprintf(static::PATTERN_FORMAT, $key), $value, $content);
        }

        return $content;
    }
}
