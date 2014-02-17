<?php

namespace AdamQuaile\RepoWatch\Events\Filters;

use AdamQuaile\RepoWatch\Events\BaseEvent;
use AdamQuaile\RepoWatch\Objects\GitRepo;

class RepositoryFilter implements FilterInterface
{

    /**
     * @var GitRepo $target
     */
    private $target;

    public function __construct(GitRepo $target)
    {
        $this->target = $target;
    }

    public function match(BaseEvent $event)
    {
        return $event->getGitRepo()->equals($this->target);
    }
}