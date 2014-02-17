<?php

namespace AdamQuaile\RepoWatch\Actions;

use AdamQuaile\RepoWatch\Users\Group;

class Email implements ActionInterface
{
    /**
     * @var Group
     */
    private $group;

    /**
     * @var string The subject line
     */
    private $subject;

    /**
     * @var string An HTML message for the email body
     */
    private $message;

    public function __construct(Group $group, $subject, $message)
    {
        $this->group = $group;

    }

    public function doAction()
    {
        // TODO: Implement doAction() method.
    }

}