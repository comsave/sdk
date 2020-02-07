<?php

namespace Comsave\Interfaces;

use GuzzleHttp\ClientInterface;

interface GuzzleClientBuilderInterface
{
    public function build(array $options = []): ClientInterface;
}