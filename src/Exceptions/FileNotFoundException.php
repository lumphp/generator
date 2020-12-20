<?php
namespace Lum\Generator\Exceptions;

use Throwable;

/**
 * Class FileNotFoundException
 *
 * @package Lum\Generator\Exceptions
 */
class FileNotFoundException extends GeneratorException
{
    /**
     * FileNotFoundException constructor.
     *
     * @param string $message
     * @param null $data
     * @param Throwable|null $previous
     */
    public function __construct(string $message = "", $data = null, Throwable $previous = null)
    {
        parent::__construct(1001, $message, $data, $previous);
    }
}
