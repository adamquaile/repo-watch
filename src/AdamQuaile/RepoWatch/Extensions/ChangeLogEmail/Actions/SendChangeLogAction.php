<?php

namespace AdamQuaile\RepoWatch\Extensions\ChangeLogEmail\Actions;

use AdamQuaile\RepoWatch\Actions\ActionInterface;
use AdamQuaile\RepoWatch\Actions\EventAwareActionInterface;
use AdamQuaile\RepoWatch\Events\BaseEvent;
use AdamQuaile\RepoWatch\Extensions\ChangeLogEmail\Strategy\ChangeLogProviderStrategy;
use AdamQuaile\RepoWatch\Objects\GitRepo;
use AdamQuaile\RepoWatch\Users\Group;

class SendChangeLogAction implements ActionInterface, EventAwareActionInterface
{

    /**
     * @var \AdamQuaile\RepoWatch\Users\Group
     */
    private $users;

    /**
     * @var \Mandrill
     */
    private $mandrill;

    /**
     * @var BaseEvent
     */
    private $event;

    /**
     * @var \AdamQuaile\RepoWatch\Extensions\ChangeLogEmail\Strategy\ChangeLogProviderStrategy
     */
    private $provider;

    private $options;

    public function __construct(Group $users, \Mandrill $mandrill, ChangeLogProviderStrategy $strategy, $options)
    {
        $this->users = $users;
        $this->mandrill = $mandrill;
        $this->provider = $strategy;
        $this->options = $options;
    }

    public function setEvent(BaseEvent $event)
    {
        $this->event = $event;
    }

    public function doAction()
    {
        $recipients = [];

        foreach ($this->users->getUsers() as $user) {
            $recipients[] = array(
                'email' => $user->getEmail(),
                'name' => $user->getName()
            );

        }

        $messageData = array(

            // Recipient
            'to' => $recipients,
            'subject' => 'Version ' . $this->event->getTag() . ' released',
            'html' => $this->provider->getChangeLog($this->event),

            'from_email' => $this->options['from']['email'],
            'from_name' => $this->options['from']['name'],

            // Message meta
            'tags' => ['duuzra', 'notifications']


        );
        $this->mandrill->messages->send($messageData);
    }


}