<?php
namespace Lum\Generator;

/**
 * Interface Generator
 *
 * @package Lum\Generator
 */
interface Generator
{
    /**
     * @param string $templatePath
     * @param array $templateData
     * @param string $outputPath
     */
    public function generate(string $templatePath, array $templateData, string $outputPath);
}