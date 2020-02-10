<?php

namespace Comsave\SDK\Interfaces;

use GuzzleHttp\ClientInterface;

interface HttpClientBuilderInterface
{
    public function build(array $options = []): ClientInterface;
}