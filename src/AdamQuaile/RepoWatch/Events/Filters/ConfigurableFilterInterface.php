<?php

namespace AdamQuaile\RepoWatch\Events\Filters;

interface ConfigurableFilterInterface extends FilterInterface
{
    /**
     * Create a new instance from the associative array given here
     *
     * @param $config
     * @return mixed
     */
    public static function fromConfig($config);
}