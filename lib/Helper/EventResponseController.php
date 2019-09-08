<?php
/**
 *  * Dawid Bednarz( dawid@bednarz.pro )
 * Read README.md file for more information and licence uses
 */

namespace DawBed\ComponentBundle\Helper;

use DawBed\ComponentBundle\Event\AbstractEvent;
use DawBed\ComponentBundle\Event\Error\ExceptionErrorEvent;
use DawBed\ComponentBundle\Event\Error\FormErrorEvent;
use DawBed\ComponentBundle\Exception\Form\IsNotSubmitException;
use DawBed\ComponentBundle\Service\EventDispatcher;
use DawBed\FileBundle\Event\Events;
use Symfony\Component\Form\FormInterface;
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

    public function notSubmittedForm(): Response
    {
        return $this->response(new ExceptionErrorEvent(Events::ERROR_RESPONSE, new IsNotSubmitException()));
    }

    public function invalidForm(FormInterface $form): Response
    {
        return $this->response(new FormErrorEvent(Events::ERROR_RESPONSE, $form));
    }

    public function exception(\Throwable $exception): Response
    {
        return $this->response(new ExceptionErrorEvent(Events::ERROR_RESPONSE, $exception));
    }

}