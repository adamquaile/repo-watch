<?php

namespace AdamQuaile\RepoWatch\Extensions\ChangeLogEmail\Strategy;

use AdamQuaile\RepoWatch\Events\BaseEvent;
use AdamQuaile\RepoWatch\Events\TagEvent;

class TagBasedFileFinder implements ChangeLogProviderStrategy
{
    private $pathToFile;

    public function __construct($pathToFile)
    {
        $this->pathToFile = $pathToFile;
    }

    public function getChangeLog(BaseEvent $event)
    {
        if ($event instanceof TagEvent) {
            $tag = $event->getTag();
        } else {
            throw new \LogicException('Unsupported event type');
        }

        $repo = $event->getGitRepo();
        if (!preg_match('/^git@github.com:(.*).git$/', $repo->getUrl(), $matches)) {
            throw new \LogicException('In development, only works with public repos on github');
        }

        $fileUrl = sprintf('http://raw.github.com/%s/%s/%s', $matches[1], $tag, $this->pathToFile($tag));

        return file_get_contents($fileUrl);

    }

    private function pathToFile($version)
    {
        $parts = explode('.', $version);

        if (count($parts) !== 3) {
            throw new \LogicException('Only semver tags currently supported');
        }

        return str_replace([':major', ':minor', ':patch'], array_values($parts), $this->pathToFile);
    }

}