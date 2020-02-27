<?php

namespace Comsave\SDK;

use Comsave\SDK\Interfaces\HttpClientBuilderInterface;
use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;

class HttpClientBuilder implements HttpClientBuilderInterface
{
    public static function build(array $options = []): ClientInterface
    {
        return new Client($options);
    }
}