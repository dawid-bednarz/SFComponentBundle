<?php

/**
 *  * Dawid Bednarz( dawid@bednarz.pro )
 * Read README.md file for more information and licence uses
 */

namespace DawBed\ComponentBundle\Event;

use DawBed\ComponentBundle\Event\Error\ExceptionErrorEvent;
use DawBed\ComponentBundle\Event\Error\FormErrorEvent;

class Events extends AbstractEvents
{
    const ERROR_RESPONSE = ExceptionErrorEvent::class | FormErrorEvent::class;

    const ALL = [
        self::ERROR_RESPONSE => self::REQUIRED,
    ];

    protected function getAll(): array
    {
        return self::ALL;
    }
}