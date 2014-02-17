<?php

namespace AdamQuaile\RepoWatch\Events\Filters;

use AdamQuaile\RepoWatch\Events\BaseEvent;

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