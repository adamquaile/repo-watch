<?php

namespace AdamQuaile\RepoWatch\Extensions;

use AdamQuaile\RepoWatch\Configuration;

interface ExtensionInterface
{
    public function register(Configuration $config);

}