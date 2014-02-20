<?php

namespace AdamQuaile\RepoWatch\Extensions\Core;

use AdamQuaile\RepoWatch\Configuration;
use AdamQuaile\RepoWatch\Extensions\Core\Filters\BranchFilter;
use AdamQuaile\RepoWatch\Extensions\Core\Filters\EventTypeFilter;
use AdamQuaile\RepoWatch\Extensions\Core\Filters\RepositoryFilter;
use AdamQuaile\RepoWatch\Extensions\Core\Filters\TagFilter;
use AdamQuaile\RepoWatch\Extensions\ExtensionInterface;

class CoreExtension implements ExtensionInterface
{
    public function register(Configuration $config)
    {
        $config->addFilter('branch', function(Configuration $config, $value) {
            return new BranchFilter($value);
        });

        $config->addFilter('repo', function(Configuration $config, $name) {
            return new RepositoryFilter($config->getRepo($name));
        });
        $config->addFilter('tag', function(Configuration $config, $name) {
            return new TagFilter($name);
        });


        $config->addFilter('type', function(Configuration $configuration, $type) {
            return new EventTypeFilter($type);
        });
    }

}