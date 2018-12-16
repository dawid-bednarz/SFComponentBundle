<?php
/**
 *  * Dawid Bednarz( dawid@bednarz.pro )
 * Read README.md file for more information and licence uses
 */
declare(strict_types=1);

namespace DawBed\ComponentBundle\Event\Error;

use DawBed\ComponentBundle\Event\AbstractResponseEvent;

class AbstractErrorEvent extends AbstractResponseEvent
{
    protected $name;

    function __construct(string $name)
    {
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }
}