<?php

namespace AdamQuaile\RepoWatch\Tasks;

use AdamQuaile\RepoWatch\Events\Filters\FilterInterface;

class Task
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var FilterInterface[]
     */
    private $filters;

    public function addFilter(FilterInterface $filter)
    {
        $this->filters[] = $filter;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

}