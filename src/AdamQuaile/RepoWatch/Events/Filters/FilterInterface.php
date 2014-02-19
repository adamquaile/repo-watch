<?php

namespace AdamQuaile\RepoWatch\Events\Filters;

use AdamQuaile\RepoWatch\Events\BaseEvent;

interface FilterInterface
{
    /**
     * Returns TRUE if and only if the event matches this filter. Returns
     * false otherwise
     *
     * @param BaseEvent $event
     *
     * @return boolean
     */
    public function match(BaseEvent $event);

}