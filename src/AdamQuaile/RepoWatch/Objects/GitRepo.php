<?php

namespace AdamQuaile\RepoWatch\Objects;

class GitRepo
{
    /**
     * @var string
     */
    private $url;

    /**
     * @var string
     */
    private $name;

    public function __construct($name, $url)
    {
        $this->name = $name;
        $this->url = $url;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    public function equals(GitRepo $repo)
    {
        return $repo->getUrl() === $this->getUrl();
    }


}