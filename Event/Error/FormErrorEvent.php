<?php
/**
 *  * Dawid Bednarz( dawid@bednarz.pro )
 * Read README.md file for more information and licence uses
 */
declare(strict_types=1);

namespace DawBed\ComponentBundle\Event\Error;

use Symfony\Component\Form\Form;

class FormErrorEvent extends AbstractErrorEvent
{
    protected $form;

    function __construct(string $name, Form $form)
    {
        parent::__construct($name);
        $this->form = $form;
    }

    public function getForm(): Form
    {
        return $this->form;
    }

    public function getName(): string
    {
        return $this->name;
    }

}