<?php

namespace Comsave\SDK;

class WebserviceClientBuilder
{
    public const PRODUCTION_WEBSERVICE_URL = 'https://webservice.comsave.com/api';
    public const HTTP_CLIENT_BUILDER_CLASS_NAME = HttpClientBuilder::class;

    public static function build(string $username, string $password, ?string $host = null): WebserviceClient
    {
        if (!$host) {
            $host = static::PRODUCTION_WEBSERVICE_URL;
        }

        $httpClientBuilderClassName = static::HTTP_CLIENT_BUILDER_CLASS_NAME;

        return new WebserviceClient(
            $httpClientBuilderClassName::build(),
            $username,
            $password,
            $host
        );
    }
}