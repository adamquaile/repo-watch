<?php

require __DIR__.'/vendor/autoload.php';

use AdamQuaile\RepoWatch\EventProcessor;
use AdamQuaile\RepoWatch\Configuration;
use AdamQuaile\RepoWatch\Events\PushEvent;
use AdamQuaile\RepoWatch\Objects\GitRepo;

$configuration = Configuration::fromFile(__DIR__ . '/app/config/parameters.yml');
$app = new EventProcessor($configuration);

$app->processTask(new PushEvent(new GitRepo("json-object-mapper", "url:")));