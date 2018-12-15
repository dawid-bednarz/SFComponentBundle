<?php
/**
 *  * Dawid Bednarz( dawid@bednarz.pro )
 * Read README.md file for more information and licence uses
 */
declare(strict_types=1);

namespace DawBed\ComponentBundle\Event\Error;

use Exception;

class ExceptionErrorEvent extends AbstractErrorEvent
{
    protected $exception;

    function __construct(string $name, Exception $exception)
    {
        parent::__construct($name);
        $this->exception = $exception;
    }

    public function getException(): Exception
    {
        return $this->exception;
    }
}