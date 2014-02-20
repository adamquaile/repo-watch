<?php

namespace AdamQuaile\RepoWatch\Extensions\ChangeLogEmail\Strategy;

use AdamQuaile\RepoWatch\Events\BaseEvent;

interface ChangeLogProviderStrategy
{
    public function getChangeLog(BaseEvent $event);
}