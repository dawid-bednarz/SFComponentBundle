<?php

/**
 * @author Dawid Bednarz( dawid@bednarz.pro )
 * @license Read README.md file for more information and licence uses
 */

namespace DawBed\ComponentBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

class UniqueEntity extends Constraint
{
    public $message = 'duplicate_value';
    public $field;
    public $entityClass;

    public function getRequiredOptions()
    {
        return ['field','entityClass'];
    }

    public function getTargets()
    {
        return self::CLASS_CONSTRAINT;
    }
}