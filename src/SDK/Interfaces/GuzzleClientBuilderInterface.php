<?php

namespace Comsave\SDK\Interfaces;

use GuzzleHttp\ClientInterface;

interface GuzzleClientBuilderInterface
{
    public function build(array $options = []): ClientInterface;
}