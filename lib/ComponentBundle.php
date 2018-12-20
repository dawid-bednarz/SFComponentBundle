<?php
/**
 *  * User: Dawid Bednarz( dawid@bednarz.pro )
 *
 */
declare(strict_types=1);

namespace DawBed\ComponentBundle;

use DawBed\ComponentBundle\DependencyInjection\ComponentExtension;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class ComponentBundle extends Bundle
{
    const DIR = __DIR__;

    public function getContainerExtension()
    {
        return new ComponentExtension;
    }
}