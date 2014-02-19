<?php

namespace AdamQuaile\RepoWatch\Extensions\Core\Filters;

use AdamQuaile\RepoWatch\Events\BaseEvent;
use AdamQuaile\RepoWatch\Events\Filters\ConfigurableFilterInterface;
use AdamQuaile\RepoWatch\Objects\GitRepo;

class RepositoryFilter implements ConfigurableFilterInterface
{

    /**
     * @var GitRepo $target
     */
    private $target;

    public function __construct(GitRepo $target)
    {
        $this->target = $target;
    }

    public function match(BaseEvent $event)
    {
        return $event->getGitRepo()->equals($this->target);
    }

    /**
     * Create a new instance from the associative array given here
     *
     * @param $config
     * @return mixed
     */
    public static function fromConfig($config)
    {
        return new RepositoryFilter(new GitRepo($config['name'], $config['url']));
    }


}