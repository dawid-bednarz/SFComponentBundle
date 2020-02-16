<?php

/**
 *  * Dawid Bednarz( dawid@bednarz.pro )
 * Read README.md file for more information and licence uses
 */

namespace DawBed\ComponentBundle\Criteria;

class ListCriteria
{
    protected $itemsOnPage = 20;
    protected $page = 1;
    protected $orderBy = [];
    protected $availableOrderBy = [];

    public static function byDynamicFields(array $fields) : self
    {
        $dynamicListCriteria = new self;
        foreach ($fields as $field) {
            $dynamicListCriteria->$field=null;
        }

        return $dynamicListCriteria;
    }

    public function addOrderBy(string $columnName, string $value): ListCriteria
    {
        $this->orderBy[$columnName] = $value;

        return $this;
    }

    public function setAvailableOrderBy(array $availableOrderBy): ListCriteria
    {
        $this->availableOrderBy = $availableOrderBy;

        return $this;
    }

    public function getAvailableOrderBy(): array
    {
        return $this->availableOrderBy;
    }

    public function getItemsOnPage(): int
    {
        return $this->itemsOnPage;
    }

    public function setItemsOnPage(?int $itemsOnPage): ListCriteria
    {
        if (is_null($itemsOnPage)) {
            $this->itemsOnPage = 1;
        } else {
            $this->itemsOnPage = $itemsOnPage;
        }
        return $this;
    }

    public function getPage(): int
    {
        return $this->page;
    }

    public function setPage(?int $page): ListCriteria
    {
        if (is_null($page)) {
            $this->page = 1;
        } else {
            $this->page = $page;
        }
        return $this;
    }

    public function getOrderBy(): ?array
    {
        return array_filter($this->orderBy);
    }

    public function setOrderBy(array $orderBy): ListCriteria
    {
        $this->orderBy = $orderBy;
        return $this;
    }
}
