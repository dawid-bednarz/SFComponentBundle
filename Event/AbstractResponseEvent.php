<?php
/**
 *  * Created by PhpStorm.
 * User: Dawid Bednarz( dawid@bednarz.pl )
 */
declare(strict_types=1);

namespace DawBed\ComponentBundle\Event;

use Symfony\Component\HttpFoundation\Response;

abstract class AbstractResponseEvent extends AbstractEvent
{
    private $response;

    public function getResponse(): ?Response
    {
        return $this->response;
    }

    public function setResponse(Response $response) : void
    {
        $this->response = $response;
    }

}