<?php
/**
 *  * Dawid Bednarz( dawid@bednarz.pro )
 * Read README.md file for more information and licence uses
 */
declare(strict_types=1);

namespace DawBed\ComponentBundle\DependencyInjection\ChildrenBundle;

use ArrayObject;

class ChildrenCollection extends ArrayObject
{
    public function getClasses(): array
    {
        $infoCollection = [];

        foreach ($this as $bundle) {
            $infoCollection[] = $bundle->getInfo()->getClass();
        }

        return $infoCollection;
    }
}