<?php
namespace Lum\Generator\Exceptions;

use Exception;
use Throwable;

/**
 * Class GeneratorException
 *
 * @package Lum\Generator\Exceptions
 */
class GeneratorException extends Exception
{
    private $data;

    /**
     * GeneratorException constructor.
     *
     * @param int $code
     * @param string $message
     * @param mixed $data
     * @param Throwable|null $previous
     */
    public function __construct(int $code, string $message = "", $data = null, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
        $this->data = $data;
    }

    /**
     * @return mixed|null
     */
    public function getData()
    {
        return $this->data;
    }
}
