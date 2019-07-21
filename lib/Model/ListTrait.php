<?php
/**
 *  * Dawid Bednarz( dawid@bednarz.pro )
 * Read README.md file for more information and licence uses
 */
namespace DawBed\ComponentBundle\Model;

trait ListTrait
{
    protected $page = 0;
    protected $total = 0;
    protected $sortColumns = [];

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

    public function getSortColumns(): array
    {
        return $this->sortColumns;
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
            'sortColumns' => $this->sortColumns
        ];
    }
}