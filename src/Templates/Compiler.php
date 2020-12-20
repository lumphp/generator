<?php namespace Lum\Generator\Templates;

/**
 * Interface Compiler
 *
 * @package Lum\Generator\Templates
 */
interface Compiler
{
    /**
     * Compile content of template file
     *
     * @param string $template
     * @param array $data
     */
    public function compile(string $template, array $data);
}
