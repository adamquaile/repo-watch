<?php

namespace AdamQuaile\RepoWatch\Extensions\Core\Filters;

use AdamQuaile\RepoWatch\Events\BaseEvent;
use AdamQuaile\RepoWatch\Events\Filters\FilterInterface;

class EventTypeFilter implements FilterInterface
{
    /**
     * @var string
     */
    private $expected;

    public function __construct($expected)
    {
        $this->expected = $expected;
    }

    /**
     * Returns TRUE if and only if the event matches this filter. Returns
     * false otherwise
     *
     * @param BaseEvent $event
     *
     * @return boolean
     */
    public function match(BaseEvent $event)
    {
        return $event->getType() == $this->expected;
    }

}