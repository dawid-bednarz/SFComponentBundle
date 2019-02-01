<?php
/**
 *  * Dawid Bednarz( dawid@bednarz.pro )
 * Read README.md file for more information and licence uses
 */
declare(strict_types=1);

namespace DawBed\ComponentBundle\Exception\Form;

class IsNotSubmitException extends \Exception
{
    public $message = 'form.is_not_send';
}