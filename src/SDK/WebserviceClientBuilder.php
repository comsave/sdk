<?php

namespace Comsave\SDK;

use Comsave\SDK\Interfaces\HttpClientBuilderInterface;

class WebserviceClientBuilder
{
    public const PRODUCTION_WEBSERVICE_URL = 'https://webservice.comsave.com/api';

    /** @var HttpClientBuilderInterface */
    private $guzzleClientBuilder;

    /**
     * @codeCoverageIgnore
     */
    public function __construct(HttpClientBuilderInterface $guzzleClientBuilder)
    {
        $this->guzzleClientBuilder = $guzzleClientBuilder;
    }

    public function build(string $username, string $password, ?string $host = null): WebserviceClient
    {
        if (!$host) {
            $host = static::PRODUCTION_WEBSERVICE_URL;
        }

        return new WebserviceClient(
            $this->guzzleClientBuilder->build(),
            $username,
            $password,
            $host
        );
    }
}