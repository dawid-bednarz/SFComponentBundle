<?php
/**
 *  * Dawid Bednarz( dawid@bednarz.pro )
 * Read README.md file for more information and licence uses
 */

namespace DawBed\ComponentBundle\Helper;

use DawBed\ComponentBundle\Event\AbstractEvent;
use DawBed\ComponentBundle\Service\EventDispatcher;
use Symfony\Component\HttpFoundation\Response;

trait EventResponseController
{
    protected $eventDispatcher;
    /**
     * @required
     */
    function setEventDispatcher(EventDispatcher $eventDispatcher)
    {
        $this->eventDispatcher = $eventDispatcher;
    }

    public function response(AbstractEvent $event): Response
    {
        return $this->eventDispatcher->dispatch($event)->getResponse();
    }
}