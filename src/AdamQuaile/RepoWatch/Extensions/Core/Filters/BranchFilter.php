<?php

namespace AdamQuaile\RepoWatch\Extensions\Core\Filters;

use AdamQuaile\RepoWatch\Events\BaseEvent;
use AdamQuaile\RepoWatch\Events\BranchBasedEventInterface;
use AdamQuaile\RepoWatch\Events\Filters\ConfigurableFilterInterface;

class BranchFilter implements ConfigurableFilterInterface
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
     * @throws \InvalidArgumentException
     * @return boolean
     */
    public function match($event)
    {
        if (!($event instanceof BranchBasedEventInterface)) {
            throw new \InvalidArgumentException('Invalid event type');
        }

        return $event->getBranch() === $this->expected;
    }

    /**
     * Create a new instance from the associative array given here
     *
     * @param $config
     * @return mixed
     */
    public static function fromConfig($config)
    {
        return new BranchFilter($config);
    }

    public function supportsEventType(BaseEvent $event)
    {
        return $event instanceof BaseEvent;
    }


}