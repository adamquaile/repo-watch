<?php

namespace AdamQuaile\RepoWatch\Tasks;

use AdamQuaile\RepoWatch\Events\Filters\FilterInterface;
use AdamQuaile\RepoWatch\Actions\ActionInterface;

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

    /**
     * @var ActionInterface[]
     */
    private $actions;

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

    /**
     * @return \AdamQuaile\RepoWatch\Events\Filters\FilterInterface[]
     */
    public function getFilters()
    {
        return $this->filters;
    }

    /**
     * @return \AdamQuaile\RepoWatch\Actions\ActionInterface[]
     */
    public function getActions()
    {
        return $this->actions;
    }

    public function addAction(ActionInterface $action)
    {
        $this->actions[] = $action;
    }


}