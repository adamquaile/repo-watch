<?php

namespace AdamQuaile\RepoWatch\Actions;

use AdamQuaile\RepoWatch\Events\BaseEvent;
use AdamQuaile\RepoWatch\Objects\GitRepo;

interface ActionInterface
{
    public function doAction();
}