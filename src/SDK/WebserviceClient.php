<?php

namespace Comsave\SDK;

use Comsave\SDK\Exception\RequestFailedException;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Message\ResponseInterface;
use Psr\Log\LoggerInterface;

class WebserviceClient
{
    /** @var ClientInterface */
    private $client;

    /** @var string */
    private $host;

    /** @var string */
    private $username;

    /** @var string */
    private $password;

    /** @var LoggerInterface */
    private $logger;

    /** @var string */
    private $token;

    /** @var int */
    private $tokenCreatedAt;

    /**
     * @codeCoverageIgnore
     */
    public function __construct(ClientInterface $client, string $username, string $password, string $host)
    {
        $this->client = $client;
        $this->username = $username;
        $this->password = $password;
        $this->host = $host;
    }

    /**
     * @throws RequestFailedException
     * @throws GuzzleException
     */
    public function request(string $method, string $uri, ?array $body = []): ResponseInterface
    {
        if (!$this->isTokenValid()) {
            $this->authenticate();
        }

        try {
            $requestUrl = vsprintf('%s%s', [
                $this->getBaseUrl(),
                $uri,
            ]);

            $response = $this->client->request($method, $requestUrl, array_filter([
                'body' => $body,
                'headers' => [
                    'X-Auth-Token' => $this->token,
                    'X-Auth-Ip' => '127.0.0.1',
                ],
            ]));
        } catch (ClientException $ex) {
            $response = $ex->getResponse();
        }

        $this->handleUnsuccessful($response);

        return $response;
    }

    /**
     * @throws RequestFailedException
     * @throws GuzzleException
     */
    public function authenticate(): void
    {
        $this->token = null;

        try {
            $response = $this->client->request('GET', vsprintf('%stoken.json?%s', [
                $this->getBaseUrl(),
                http_build_query([
                    'type' => 'wholesale',
                    'ip' => '127.0.0.1',
                    'email' => $this->getUsername(),
                    'password' => $this->getPassword(),
                ]),
            ]));
        } catch (ClientException $ex) {
            $response = $ex->getResponse();
        }

        $this->handleUnsuccessful($response);

        $this->token = json_decode((string)$response->getBody())->token;
        $this->tokenCreatedAt = time();
    }

    /**
     * @throws RequestFailedException
     */
    public function handleUnsuccessful(ResponseInterface $response): void
    {
        if (!$this->isSuccess($response)) {
            throw new RequestFailedException(
                $response->getStatusCode(),
                $response->getBody()
            );
        }
    }

    public function isSuccess(ResponseInterface $response): bool
    {
        $decodedBody = json_decode($response->getBody(), true);

        return (isset($decodedBody['success']) && $decodedBody['success'] === true) || 200 === $response->getStatusCode();
    }

    public function getBaseUrl(): string
    {
        return rtrim($this->host, '/').'/';
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    /** @required */
    public function setLogger(LoggerInterface $logger): void
    {
        $this->logger = $logger;
    }

    private function isTokenValid(): bool
    {
        return !$this->token || time() - $this->tokenCreatedAt > 60 * 60 * 23;
    }
}