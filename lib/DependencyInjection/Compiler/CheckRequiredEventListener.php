<?php
/**
 *  * Dawid Bednarz( dawid@bednarz.pro )
 * Read README.md file for more information and licence uses
 */
declare(strict_types=1);

namespace DawBed\ComponentBundle\DependencyInjection\Compiler;

use DawBed\ComponentBundle\Event\Events;
use DawBed\ComponentBundle\Exception\InstallationException;
use DawBed\ComponentBundle\Service\ChildrenBundleService;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class CheckRequiredEventListener implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        foreach ($container->get(ChildrenBundleService::class)->getBundleInfo() as $child) {
            $this->check($child->getEvents(), $container);
        }
        $this->check(Events::class, $container);
    }

    private function check(string $eventClass, ContainerBuilder $container) : void
    {
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
            if ($notFoundListener) {
                throw new InstallationException(sprintf('"%s" Some event listener is required for propertly working this bundle. Check %s class to get more information', $key, get_class($events)));
            }
        }
    }
}
