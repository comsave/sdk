<?php

namespace Comsave\SDK;

use Comsave\Interfaces\GuzzleClientBuilderInterface;
use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;

class GuzzleClientBuilder implements GuzzleClientBuilderInterface
{
    public function build(array $options = []): ClientInterface
    {
        return new Client($options);
    }
}