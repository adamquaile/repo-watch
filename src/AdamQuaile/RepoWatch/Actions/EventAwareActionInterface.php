<?php

namespace AdamQuaile\RepoWatch\Actions;

use AdamQuaile\RepoWatch\Events\BaseEvent;

interface EventAwareActionInterface
{
    public function setEvent(BaseEvent $event);
}