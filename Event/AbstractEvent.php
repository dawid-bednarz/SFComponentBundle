<?php
/**
 *  * Dawid Bednarz( dawid@bednarz.pro )
 * Read README.md file for more information and licence uses
 */
declare(strict_types=1);

namespace DawBed\ComponentBundle\Event;

use Symfony\Component\EventDispatcher\Event;

abstract class AbstractEvent extends Event
{
    public abstract function getName(): string;

    public function __toString(): string
    {
        return $this->getName();
    }
}