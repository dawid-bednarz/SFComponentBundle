<?php
declare(strict_types=1);

namespace DawBed\ComponentBundle\Enum;
/**
 *  * Dawid Bednarz( dawid@bednarz.pro )
 * Read README.md file for more information and licence uses
 */
class Enum
{
    private $value;

    public function __construct(string $value)
    {
        $reflection = new \ReflectionClass($this);
        if (!in_array($value, $reflection->getConstants())) {
            throw new \InvalidArgumentException();
        }
        $this->value = $value;
    }

    public function is(string $value): bool
    {
        return $this->value === $value;
    }

    public function __toString() : string
    {
        return $this->value;
    }
}
