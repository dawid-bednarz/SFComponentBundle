<?php
/**
 *  * Dawid Bednarz( dawid@bednarz.pro )
 * Read README.md file for more information and licence uses
 */
declare(strict_types=1);

namespace DawBed\ComponentBundle\DependencyInjection\ChildrenBundle;

class BundleInfo
{
    private $class;

    function __construct(string $class)
    {
        $this->class = $class;
    }

    public function getClass(): string
    {
        return $this->class;
    }

    public function exists()
    {
        return class_exists($this->class);
    }

    public function getAlias(): string
    {
        return $this->class::getAlias();
    }

    public function getEvents()
    {
        return $this->class::getEvents();
    }

}