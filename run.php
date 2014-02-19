<?php

require __DIR__.'/vendor/autoload.php';

use AdamQuaile\RepoWatch\EventProcessor;
use AdamQuaile\RepoWatch\Configuration;
use AdamQuaile\RepoWatch\Events\PushEvent;
use AdamQuaile\RepoWatch\Objects\GitRepo;
use AdamQuaile\RepoWatch\Extensions\ChangeLogEmail\ChangeLogEmailExtension;

$configuration = Configuration::fromFile(__DIR__ . '/app/config/parameters.yml');

$configuration->registerExtension(new ChangeLogEmailExtension());

$app = new EventProcessor($configuration);

$app->processTask(

    new PushEvent(
        new GitRepo("json-object-mapper", "git@github.com:adamquaile/json-object-mapper.git"),
        'master'
    )
);
