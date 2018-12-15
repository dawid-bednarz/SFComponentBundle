<?php
/**
 *  * Created by PhpStorm.
 * User: Dawid Bednarz( dawid@bednarz.pl )
 */
declare(strict_types=1);

namespace DawBed\ComponentBundle\Exception\Form;

use Symfony\Component\Form\Form;

class BaseException extends \Exception
{
    private $form;

    function __construct(Form $form)
    {
        $this->form = $form;
    }

    public function getForm(): Form
    {
        return $this->form;
    }
}