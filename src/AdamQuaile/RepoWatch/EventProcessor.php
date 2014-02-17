<?php

namespace AdamQuaile\RepoWatch;

use AdamQuaile\RepoWatch\Events\BaseEvent;

class EventProcessor
{

    /**
     * @var Configuration
     */
    private $config;

    public function __construct(Configuration $config)
    {
        $this->config = $config;
    }

    public function processTask(BaseEvent $event)
    {
        foreach ($this->config->getTasks() as $task) {
            var_dump($task);
        }
    }
}