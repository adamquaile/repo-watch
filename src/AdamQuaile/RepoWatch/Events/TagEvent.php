<?php

namespace AdamQuaile\RepoWatch\Events;

use AdamQuaile\RepoWatch\Objects\GitRepo;
use AdamQuaile\RepoWatch\Events\BranchBasedEventInterface;

class TagEvent extends BaseEvent
{

    private $tag;


    public function __construct(GitRepo $gitRepo, $tag)
    {
        parent::__construct($gitRepo);

        $this->tag = $tag;
    }


    public function getType()
    {
        return 'tag';
    }

    public function getTag()
    {
        return $this->tag;
    }

}