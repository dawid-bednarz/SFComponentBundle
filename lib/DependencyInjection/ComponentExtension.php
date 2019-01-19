<?php
/**
 *  * Dawid Bednarz( dawid@bednarz.pro )
 * Read README.md file for more information and licence uses
 */
declare(strict_types=1);

namespace DawBed\ComponentBundle\DependencyInjection;

use DawBed\ComponentBundle\Command\EventListenerDebugerCommand;
use DawBed\ComponentBundle\DependencyInjection\ChildrenBundle\Bundle;
use DawBed\ComponentBundle\DependencyInjection\ChildrenBundle\BundleInfo;
use DawBed\ComponentBundle\DependencyInjection\ChildrenBundle\ChildrenCollection;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Extension\PrependExtensionInterface;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class ComponentExtension extends Extension implements PrependExtensionInterface
{
    private $childrenBundleInfo;

    function __construct()
    {
        new Configuration;
    }

    public function prepend(ContainerBuilder $container)
    {
        $childrenBundle = new ChildrenCollection([
            new Bundle(new BundleInfo('DawBed\UserRegistrationConfirmationBundle\UserRegistrationConfirmationBundle'), $container),
            new Bundle(new BundleInfo('DawBed\UserRegistrationBundle\UserRegistrationBundle'), $container),
            new Bundle(new BundleInfo('DawBed\UserConfirmationBundle\UserConfirmationBundle'), $container),
            new Bundle(new BundleInfo('DawBed\ConfirmationBundle\ConfirmationBundle'), $container),
            new Bundle(new BundleInfo('DawBed\AuthBundle\AuthBundle'), $container)
        ]);
        /**
         * @var Bundle $bundle
         */
        foreach ($childrenBundle as $key => $bundle) {
            if (!$bundle->exists() || !$container->hasExtension($bundle->getAlias())) {
                unset($childrenBundle[$key]);
                continue;
            }
            $bundle->setContainer($container);
            $bundle->checkHasRegisteredListeners();
        }
        $this->childrenBundleInfo = $childrenBundle->getClasses();
    }

    public function load(array $configs, ContainerBuilder $container)
    {
        $container->setParameter('bundle_dir', dirname(__DIR__));
        $loader = new YamlFileLoader($container, new FileLocator(dirname(__DIR__) . '/Resources/config'));
        $loader->load('services.yaml');

        $eventListenerDebugCommand = new Definition(EventListenerDebugerCommand::class, [
            EventListenerDebugerCommand::NAME,
            $this->getDebugEventCommands($configs),
            $this->childrenBundleInfo,
            new Reference(EventDispatcherInterface::class)
        ]);
        $container->setDefinition(EventListenerDebugerCommand::class, $eventListenerDebugCommand)
            ->addTag('console.command', ['command' => EventListenerDebugerCommand::NAME]);

        unset($this->childrenBundleInfo);
    }

    public function getAlias(): string
    {
        return 'dawbed_component_bundle';
    }

    private function getDebugEventCommands(array $configs): array
    {
        $commands = [];
        foreach ($configs as $config) {
            if (array_key_exists(Configuration::NODE_DEBUG_EVENT_COMMANDS, $config)) {
                foreach ($config[Configuration::NODE_DEBUG_EVENT_COMMANDS] as $type) {
                    $commands[] = $type;
                }
            }
        }
        return $commands;
    }
}