<?php
/**
 *  * Dawid Bednarz( dawid@bednarz.pro )
 * Read README.md file for more information and licence uses
 */
declare(strict_types=1);

namespace DawBed\ComponentBundle\Helper;

class ClassHelper
{
    public static function name(string $namespace): string
    {
        return substr(strrchr($namespace, '\\'), 1);
    }
}