<?php

/**
 *  * Dawid Bednarz( dawid@bednarz.pro )
 * Read README.md file for more information and licence uses
 */

namespace DawBed\ComponentBundle\Criteria;

use DawBed\ComponentBundle\Enum\WriteTypeEnum;

trait WriteTypeCriteriaTrait
{
    /**
     * @var WriteTypeEnum
     */
    protected $typeOfCriteria;

    public function setTypeOfCriteria(WriteTypeEnum $typeOfCriteria): self
    {
        $this->typeOfCriteria = $typeOfCriteria;

        return self;
    }

    public function isCreateCriteria(): bool
    {
        return $this->typeOfCriteria->is(WriteTypeEnum::CREATE);
    }

    public function isDeleteCriteria(): bool
    {
        return $this->typeOfCriteria->is(WriteTypeEnum::DELETE);
    }

    public function isUpdateCriteria(): bool
    {
        return $this->typeOfCriteria->is(WriteTypeEnum::UPDATE);
    }
}