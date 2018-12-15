<?php
/**
 *  * Dawid Bednarz( dawid@bednarz.pro )
 * Read README.md file for more information and licence uses
 */
declare(strict_types=1);

namespace DawBed\ComponentBundle\DependencyInjection\ChildrenBundle;

use DawBed\ComponentBundle\Exception\InstallationException;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class Bundle
{
    private $containerBuilder;
    private $info;

    function __construct(BundleInfo $info)
    {
        $this->info = $info;
    }

    public function setContainer(ContainerBuilder $containerBuilder)
    {
        $this->containerBuilder = $containerBuilder;
    }

    public function getInfo(): BundleInfo
    {
        return $this->info;
    }

    function __call($name, $arguments)
    {
        return $this->info->$name(...$arguments);
    }

    public function checkHasRegisteredListeners()
    {
        $eventClass = $this->info->getEvents();
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
        }
    }
}