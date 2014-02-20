<?php

namespace AdamQuaile\RepoWatch\Users;

class Group
{
    /**
     * @var User[]
     */
    private $users;

    /**
     * @param User $user
     */
    public function addUser(User $user)
    {
        $this->users[] = $user;
    }

    /**
     * @return User[]
     */
    public function getUsers()
    {
        return $this->users;
    }



}