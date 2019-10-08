<?php
/**
 *  * User: Dawid Bednarz( dawid@bednarz.pro )
 *
 */
declare(strict_types=1);

namespace DawBed\ComponentBundle;

use DawBed\ComponentBundle\DependencyInjection\Compiler\CheckRequiredEventListener;
use DawBed\ComponentBundle\DependencyInjection\ComponentExtension;
use Symfony\Component\DependencyInjection\Compiler\PassConfig;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class ComponentBundle extends Bundle
{
    public function getContainerExtension()
    {
        return new ComponentExtension();
    }

    public function build(ContainerBuilder $container)
    {
        $container->addCompilerPass(new CheckRequiredEventListener(), PassConfig::TYPE_BEFORE_OPTIMIZATION, 1000);

        parent::build($container);
    }
}