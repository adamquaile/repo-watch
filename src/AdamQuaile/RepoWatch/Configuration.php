<?php

namespace AdamQuaile\RepoWatch;

use AdamQuaile\RepoWatch\Events\Filters\EventTypeFilter;
use AdamQuaile\RepoWatch\Events\Filters\RepositoryFilter;
use AdamQuaile\RepoWatch\Tasks\Task;
use Symfony\Component\Yaml\Yaml;

class Configuration
{
    /**
     * @var string
     */
    private $configRaw;

    public static function fromFile($filename)
    {
        return new Configuration(Yaml::parse(file_get_contents($filename)));
    }

    public function __construct($config)
    {
        $this->configRaw = $config['parameters'];

        var_dump($config);
    }

    /**
     * @return Task[]
     */
    public function getTasks()
    {
        $tasks = [];

        foreach ($this->configRaw['tasks'] as $name => $info) {
            $tasks[] = $this->parseTask($name, $info);
        }

        return $tasks;
    }

    private function parseTask($name, $info)
    {
        $task = new Task();
        $task->setName($name);

        if (array_key_exists('on', $info)) {
            $task->addFilter(new EventTypeFilter($info['on']));
        }
        if (array_key_exists('matching', $info)) {
            foreach ($info['matching'] as $name => $value) {
                $task->addFilter($this->locateFilter($name, $value));
            }
        }

        return $task;
    }

    private function locateFilter($key, $value)
    {

    }
}