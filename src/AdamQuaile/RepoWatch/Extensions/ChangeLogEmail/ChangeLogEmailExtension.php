<?php

namespace AdamQuaile\RepoWatch\Extensions\ChangeLogEmail;

use AdamQuaile\RepoWatch\Configuration;
use AdamQuaile\RepoWatch\Extensions\ChangeLogEmail\Actions\SendChangeLogAction;
use AdamQuaile\RepoWatch\Extensions\ExtensionInterface;

class ChangeLogEmailExtension implements ExtensionInterface
{
    public function register(Configuration $config)
    {
        $config->addAction('changelog_email', function(Configuration $config, $options) {
            return new SendChangeLogAction(new \Mandrill($config->get('mandrill_api_key')));
        });
    }


}