<?php

namespace AdamQuaile\RepoWatch\Events;

use Symfony\Component\EventDispatcher\Event;
use AdamQuaile\RepoWatch\Objects\GitRepo;

abstract class BaseEvent extends Event
{

    abstract public function getType();

    /**
     * @var GitRepo
     */
    private $gitRepo;

    public function __construct(GitRepo $gitRepo)
    {
        $this->gitRepo = $gitRepo;
    }

    /**
     * @return \AdamQuaile\RepoWatch\Objects\GitRepo
     */
    public function getGitRepo()
    {
        return $this->gitRepo;
    }


}