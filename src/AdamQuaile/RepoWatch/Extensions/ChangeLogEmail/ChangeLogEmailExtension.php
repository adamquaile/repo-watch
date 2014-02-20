<?php

namespace AdamQuaile\RepoWatch\Extensions\ChangeLogEmail;

use AdamQuaile\RepoWatch\Configuration;
use AdamQuaile\RepoWatch\Extensions\ChangeLogEmail\Actions\SendChangeLogAction;
use AdamQuaile\RepoWatch\Extensions\ChangeLogEmail\Strategy\TagBasedFileFinder;
use AdamQuaile\RepoWatch\Extensions\ExtensionInterface;

class ChangeLogEmailExtension implements ExtensionInterface
{
    public function register(Configuration $config)
    {
        $config->addAction('changelog_email', function(Configuration $config, $options) {

            $users = $config->parseGroup($options['users']);

            if (!isset($options['strategy'])) {
                $options['strategy'] = array(
                    'simple' => 'changelog.md'
                );
            }

            $strategy = $this->parseStrategy($options['strategy']);

            return new SendChangeLogAction($users, new \Mandrill($config->get('mandrill_api_key')), $strategy, $options);
        });
    }

    public function parseStrategy($options)
    {
        if (!is_array($options) || (count($options) != 1)) {
            throw new \LogicException('Strategy not understood');
        }
        $type = array_keys($options)[0];

        switch ($type) {
            case 'tag_based_file_path':
                return new TagBasedFileFinder($options[$type]);
            default:
                throw new \InvalidArgumentException('Strategy ' . $type . 'not understood');
        }

    }


}