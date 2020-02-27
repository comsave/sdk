<?php

namespace Comsave\SDK\Interfaces;

use GuzzleHttp\ClientInterface;

interface HttpClientBuilderInterface
{
    public static function build(array $options = []): ClientInterface;
}