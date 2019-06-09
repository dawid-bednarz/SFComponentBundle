<?php
/**
 *  * Dawid Bednarz( dawid@bednarz.pro )
 * Read README.md file for more information and licence uses
 */
declare(strict_types=1);

namespace DawBed\ComponentBundle\DependencyInjection\Compiler;

use DawBed\ComponentBundle\ComponentBundle;
use DawBed\ComponentBundle\Exception\InstallationException;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class CheckRequiredEventListener implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        foreach (ComponentBundle::getChildren() as $child) {
            $eventClass = $child->getEvents();
            $events = new $eventClass;
            $eventsIterator = $events->getRequired();
            $notFoundListener = false;
            foreach ($eventsIterator as $key => $val) {
                foreach ($container->findTaggedServiceIds('kernel.event_listener') as $arrayEventsTag) {
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
            }
        }
    }
}