<?php

namespace AdamQuaile\RepoWatch;

use AdamQuaile\RepoWatch\Extensions\Core\CoreExtension;
use AdamQuaile\RepoWatch\Extensions\ExtensionInterface;
use AdamQuaile\RepoWatch\Objects\GitRepo;
use AdamQuaile\RepoWatch\Tasks\Task;
use Symfony\Component\Yaml\Yaml;
use AdamQuaile\RepoWatch\Events\Filters\FilterInterface;
use AdamQuaile\RepoWatch\Actions\ActionInterface;

class Configuration
{
    /**
     * @var string
     */
    private $config;

    /**
     * @var FilterInterface[]|callable[]
     */
    private $filters;

    /**
     * @var ActionInterface[]|callable[]
     */
    private $actions;

    public static function fromFile($filename)
    {
        return new Configuration(Yaml::parse(file_get_contents($filename)));
    }

    public function __construct($config)
    {
        $this->config = $config['parameters'];

        $this->registerExtension(new CoreExtension());

    }

    public function get($key)
    {
        return $this->config[$key];
    }

    /**
     * @return Task[]
     */
    public function getTasks()
    {
        $tasks = [];

        foreach ($this->config['tasks'] as $name => $info) {
            $tasks[] = $this->parseTask($name, $info);
        }

        return $tasks;
    }

    private function parseTask($name, $info)
    {
        $task = new Task();
        $task->setName($name);

        if (array_key_exists('on', $info)) {
            $task->addFilter($this->locateFilter('type', $info['on']));
        }
        if (array_key_exists('matching', $info)) {
            foreach ($info['matching'] as $name => $value) {
                $task->addFilter($this->locateFilter($name, $value));
            }
        }
        if (array_key_exists('actions', $info)) {
            foreach ($info['actions'] as $name => $value) {
                $task->addAction($this->locateAction($name, $value));
            }
        }

        return $task;
    }

    private function locateFilter($key, $value)
    {
        $filter = $this->filters[$key];

        if ($filter instanceof FilterInterface) {
            return $filter;
        }

        return call_user_func_array($filter, [$this, $value]);

    }

    public function getRepo($name)
    {
        $repo = $this->config['repos'][$name];

        return new GitRepo($repo['name'], $repo['url']);
    }

    private function locateAction($key, $value)
    {
        $action = $this->actions[$key];

        if ($action instanceof ActionInterface) {
            return $action;
        }

        return call_user_func_array($action, [$this, $value]);
    }


    public function addFilter($name, $filter)
    {
        $this->filters[$name] = $filter;
    }

    public function addAction($name, $action)
    {
        $this->actions[$name] = $action;
    }



    public function registerExtension(ExtensionInterface $extension)
    {
        $extension->register($this);
    }

}