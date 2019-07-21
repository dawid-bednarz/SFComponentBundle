<?php
/**
 *  * Dawid Bednarz( dawid@bednarz.pro )
 * Read README.md file for more information and licence uses
 */
declare(strict_types=1);

namespace DawBed\ComponentBundle\Service;

abstract class AbstractEntityService
{
    protected $entities = [];

    function __construct(array $entities)
    {
        $this->entities = $entities;
    }

    function __get(string $name): string
    {
        if (!array_key_exists($name, $this->entities)) {
            throw new \Exception(sprintf('Unknown entity %s', $name));
        }
        return $this->entities[$name];
    }

}