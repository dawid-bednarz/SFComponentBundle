<?php

/**
 *  * Dawid Bednarz( dawid@bednarz.pro )
 * Read README.md file for more information and licence uses
 */

namespace DawBed\ComponentBundle\Enum;

use DawBed\ComponentBundle\Enum\Enum;

class WriteTypeEnum extends Enum
{
    const CREATE = 'create';
    const UPDATE = 'update';
    const DELETE = 'delete';
}