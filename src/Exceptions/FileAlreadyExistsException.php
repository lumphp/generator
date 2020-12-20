<?php
namespace Lum\Generator\Exceptions;

use Throwable;

/**
 * Class FileAlreadyExistsException
 *
 * @package Generator\Exceptions
 */
class FileAlreadyExistsException extends GeneratorException
{
    /**
     * FileAlreadyExistsException constructor.
     *
     * @param string $message
     * @param null $data
     * @param Throwable|null $previous
     */
    public function __construct(string $message = "", $data = null, Throwable $previous = null)
    {
        parent::__construct(1002, $message, $data, $previous);
    }
}
