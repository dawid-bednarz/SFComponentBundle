<?php
/**
 *  * Created by PhpStorm.
 * User: Dawid Bednarz( dawid@bednarz.pro )
 */
declare(strict_types=1);

namespace DawBed\ComponentBundle\Event;

abstract class AbstractEvents implements \IteratorAggregate
{
    const REQUIRED = 1;
    const OPTIONAL = 2;

    public function getIterator(): \ArrayIterator
    {
        return new \ArrayIterator($this->getAll());
    }

    public function getRequired()
    {
        return new class($this->getIterator()) extends \FilterIterator
        {
            public function accept()
            {
                return $this->getInnerIterator()->current() === AbstractEvents::REQUIRED;
            }
        };
    }

    abstract protected function getAll(): array;
}