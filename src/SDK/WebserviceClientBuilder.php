<?php

namespace Comsave\SDK;

use Comsave\SDK\Interfaces\GuzzleClientBuilderInterface;
use GuzzleHttp\Client;

class WebserviceClientBuilder
{
    public const PRODUCTION_WEBSERVICE_URL = 'https://webservice.comsave.com/api';

    /** @var GuzzleClientBuilderInterface */
    private $guzzleClientBuilder;

    /**
     * @codeCoverageIgnore
     */
    public function __construct(GuzzleClientBuilderInterface $guzzleClientBuilder)
    {
        $this->guzzleClientBuilder = $guzzleClientBuilder;
    }

    public function build(string $username, string $password, ?string $host = null): WebserviceClient
    {
        if(!$host) {
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