<?php
/**
 *  * Dawid Bednarz( dawid@bednarz.pro )
 * Read README.md file for more information and licence uses
 */
declare(strict_types=1);

namespace DawBed\ComponentBundle\DependencyInjection\ChildrenBundle;

interface ComponentBundleInterface
{
    public static function getEvents(): ?string;
    public static function getAlias(): string;
}