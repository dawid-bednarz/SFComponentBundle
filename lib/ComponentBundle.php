<?php
/**
 *  * User: Dawid Bednarz( dawid@bednarz.pro )
 *
 */
declare(strict_types=1);

namespace DawBed\ComponentBundle;

use DawBed\ComponentBundle\DependencyInjection\ChildrenBundle\BundleInfo;
use DawBed\ComponentBundle\DependencyInjection\Compiler\CheckRequiredEventListener;
use DawBed\ComponentBundle\DependencyInjection\ComponentExtension;
use Symfony\Component\DependencyInjection\Compiler\PassConfig;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class ComponentBundle extends Bundle
{
    private static $childrenBundle = [];

    public static function getChildren(): array
    {
        return self::$childrenBundle;
    }

    public function getContainerExtension()
    {
        return new ComponentExtension();
    }

    public function build(ContainerBuilder $container)
    {
        foreach ([
                     new BundleInfo('DawBed\UserRegistrationConfirmationBundle\UserRegistrationConfirmationBundle'),
                     new BundleInfo('DawBed\UserRegistrationBundle\UserRegistrationBundle'),
                     new BundleInfo('DawBed\UserConfirmationBundle\UserConfirmationBundle'),
                     new BundleInfo('DawBed\ConfirmationBundle\ConfirmationBundle'),
                     new BundleInfo('DawBed\AclBundle\AclBundle'),
                     new BundleInfo('DawBed\AuthBundle\AuthBundle'),
                     new BundleInfo('DawBed\UserAclBundle\UserAclBundle'),
                     new BundleInfo('DawBed\FileBundle\FileBundle'),
                 ] as $bundle) {
            if ($container->hasExtension($bundle->getAlias())) {
                self::$childrenBundle[] = $bundle;
            }
        }
        $container->addCompilerPass(new CheckRequiredEventListener(), PassConfig::TYPE_BEFORE_OPTIMIZATION, 1000);
        parent::build($container);
    }
}