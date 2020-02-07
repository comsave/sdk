<?php

namespace Comsave\SDK;

use GuzzleHttp\Client;

class WebserviceClientBuilder
{
    public const PRODUCTION_WEBSERVICE_URL = 'https://webservice.comsave.com/api';

    public function build(string $username, string $password, ?string $host = null): WebserviceClient
    {
        if(!$host) {
            $host = static::PRODUCTION_WEBSERVICE_URL;
        }

        return new WebserviceClient(
            $this->buildGuzzleClient(),
            $username,
            $password,
            $host
        );
    }

    protected function buildGuzzleClient(array $options = []): Client
    {
        return new Client($options);
    }
}