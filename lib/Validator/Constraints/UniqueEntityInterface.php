<?php

/**
 * @author Dawid Bednarz( dawid@bednarz.pro )
 * @license Read README.md file for more information and licence uses
 */

namespace DawBed\ComponentBundle\Validator\Constraints;

interface UniqueEntityInterface
{
    public function getOldUniqueValue();
}