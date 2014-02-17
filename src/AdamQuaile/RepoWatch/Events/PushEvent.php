<?php

namespace AdamQuaile\RepoWatch\Events;

class PushEvent extends BaseEvent
{
    public function getType()
    {
        return 'push';
    }

}