<?php

namespace AdamQuaile\RepoWatch\Events;

use AdamQuaile\RepoWatch\Objects\GitRepo;
use AdamQuaile\RepoWatch\Events\BranchBasedEventInterface;

class PushEvent extends BaseEvent implements BranchBasedEventInterface
{

    private $branch;


    public function __construct(GitRepo $gitRepo, $branch)
    {
        parent::__construct($gitRepo);

        $this->branch = $branch;
    }


    public function getType()
    {
        return 'push';
    }

    public function getBranch()
    {
        return $this->branch;
    }

}