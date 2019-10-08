<?php

/**
 * @author Dawid Bednarz( dawid@bednarz.pro )
 * @license Read README.md file for more information and licence uses
 */

namespace DawBed\ComponentBundle\Service;

use DawBed\ComponentBundle\DependencyInjection\ChildrenBundle\BundleInfo;

class ChildrenBundleService
{
    private $children;

    public function __construct(array $children)
    {
        $this->children = $children;
    }

    public function getBundleInfo() : \Generator
    {
        foreach ($this->children as $child) {
            yield new BundleInfo($child);
        }
    }
}