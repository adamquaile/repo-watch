<?php

namespace AdamQuaile\RepoWatch\Extensions\Core\Filters;

use AdamQuaile\RepoWatch\Events\BaseEvent;
use AdamQuaile\RepoWatch\Events\Filters\FilterInterface;
use AdamQuaile\RepoWatch\Events\TagEvent;

class TagFilter implements FilterInterface
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
     * @param TagEvent $event
     *
     * @return boolean
     */
    public function match($event)
    {
        return preg_match($this->expected, $event->getTag());
    }

    public function supportsEventType(BaseEvent $event)
    {
        return $event instanceof TagEvent;
    }


}