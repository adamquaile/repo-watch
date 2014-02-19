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

            printf('Testing task %s', $task->getName());

            $matched = true;

            $filters = $task->getFilters();

            if (count($filters) == 0) {
                throw new \LogicException('Task with no filters');
            }

            // Test against all filters

            foreach ($filters as $filter) {
                $matchedCurrentFilter = $filter->match($event);

                printf("\n<br />".'- Testing filter %s: %s', get_class($filter), $matchedCurrentFilter ? 'true' : 'false');

                if (!$matchedCurrentFilter) {
                    $matched = false;
                    break;
                }
            }

            if ($matched) {
                var_dump($task);
            }


        }
    }
}