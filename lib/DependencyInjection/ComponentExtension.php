<?php
/**
 *  * Dawid Bednarz( dawid@bednarz.pro )
 * Read README.md file for more information and licence uses
 */
declare(strict_types=1);

namespace DawBed\ComponentBundle\DependencyInjection;

use DawBed\ComponentBundle\Command\EventListenerDebugerCommand;
use DawBed\ComponentBundle\ComponentBundle;
use DawBed\ComponentBundle\DependencyInjection\ChildrenBundle\Bundle;
use DawBed\ComponentBundle\DependencyInjection\ChildrenBundle\BundleInfo;
use DawBed\ComponentBundle\DependencyInjection\ChildrenBundle\ChildrenCollection;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpKernel\KernelInterface;

class ComponentExtension extends Extension
{

    public function getAlias(): string
    {
        return 'dawbed_component_bundle';
    }

    public function load(array $configs, ContainerBuilder $container)
    {
        $container->setParameter('bundle_dir', dirname(__DIR__));
        $loader = new YamlFileLoader($container, new FileLocator(dirname(__DIR__) . '/Resources/config'));
        $loader->load('services.yaml');
        new Configuration;
        $this->prepareEventListenerDebugCommand($this->getDebugEventCommands($configs), $container);
    }

    private function prepareEventListenerDebugCommand(array $debugEventCommands, ContainerBuilder $container): void
    {
        $eventListenerDebugCommand = new Definition(EventListenerDebugerCommand::class, [
            EventListenerDebugerCommand::NAME,
            $debugEventCommands,
            new Reference(EventDispatcherInterface::class)
        ]);
        $container->setDefinition(EventListenerDebugerCommand::class, $eventListenerDebugCommand)
            ->addTag('console.command', ['command' => EventListenerDebugerCommand::NAME]);
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

/*$eventClass = $this->info->getEvents();
$events = new $eventClass;
$eventsIterator = $events->getRequired();

$notFoundListener = false;
foreach ($eventsIterator as $key => $val) {
    foreach ($this->containerBuilder->findTaggedServiceIds('kernel.event_listener') as $arrayEventsTag) {
        if (in_array($key, array_column($arrayEventsTag, 'event'))) {
            $notFoundListener = false;
            break 1;
        } else {
            $notFoundListener = true;
        }
    }
}
if ($notFoundListener) {
    throw new InstallationException(sprintf('"%s" Some event listener is required for propertly working this bundle. Check %s class to get more information', $key, get_class($events)));
}*/