<?php
/**
 *  * Dawid Bednarz( dawid@bednarz.pro )
 * Read README.md file for more information and licence uses
 */

namespace DawBed\ComponentBundle\Model;

use DawBed\ComponentBundle\Criteria\ListCriteria;
use Pagerfanta\Pagerfanta;

trait ListTrait
{
    protected $page = 0;
    protected $total = 0;
    protected $sortColumns = [];
    protected $availableSortColumns = [];

    public function setListMetadata(Pagerfanta $pagerfanta, ListCriteria $criteria) : void
    {
        try {
            $pagerfanta->setMaxPerPage($criteria->getItemsOnPage());
            $pagerfanta->setCurrentPage($criteria->getPage());
        } catch (\Exception $exception) {
            $this->setPage($pagerfanta->getNbPages());
            return;
        }
        $this
            ->setSortColumns($criteria->getOrderBy())
            ->setAvailableSortColumns($criteria->getAvailableOrderBy())
            ->setPage($pagerfanta->getNbResults() === 0 ? 0 : $pagerfanta->getNbPages())
            ->setTotal($pagerfanta->getNbResults());
    }

    public function setPage(int $page): self
    {
        $this->page = $page;

        return $this;
    }

    public function setSortColumns(array $columns): self
    {
        $this->sortColumns = $columns;

        return $this;
    }

    public function setAvailableSortColumns(array $availableSortColumns): self
    {
        $this->availableSortColumns = $availableSortColumns;

        return $this;
    }

    public function getSortColumns(): array
    {
        return $this->sortColumns;
    }

    public function getKeySortColumns(): array
    {
        return array_keys($this->sortColumns);
    }

    public function getTotal(): int
    {
        return $this->total;
    }

    public function setTotal(int $total): self
    {
        $this->total = $total;

        return $this;
    }

    public function getMetadata(): array
    {
        return [
            'pages' => $this->page,
            'total' => $this->total,
            'sortColumns' => (object)$this->sortColumns,
            'availableSortColumns' => $this->availableSortColumns,
        ];
    }
}
