<?php

namespace Comsave\Tests\SDK;

use Comsave\SDK\Interfaces\HttpClientBuilderInterface;
use Comsave\SDK\WebserviceClientBuilder;
use Comsave\Tests\Traits\FakerTrait;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class WebserviceClientBuilderTest extends TestCase
{
    use FakerTrait;

    public function testBuildSetsCorrectlyUsername(): void
    {
        $username = $this->getFaker()->userName;
        $password = $this->getFaker()->password;

        $wsClient = WebserviceClientBuilder::build(
            $username,
            $password
        );

        $this->assertEquals($username, $wsClient->getUsername());
    }

    public function testBuildSetsCorrectlyPassword(): void
    {
        $username = $this->getFaker()->userName;
        $password = $this->getFaker()->password;

        $wsClient = WebserviceClientBuilder::build(
            $username,
            $password
        );

        $this->assertEquals($password, $wsClient->getPassword());
        $this->assertEquals(sprintf('%s/', WebserviceClientBuilder::PRODUCTION_WEBSERVICE_URL), $wsClient->getBaseUrl());
    }

    public function testBuildSetsCorrectlyHostWhenNull(): void
    {
        $username = $this->getFaker()->userName;
        $password = $this->getFaker()->password;

        $wsClient = WebserviceClientBuilder::build(
            $username,
            $password
        );

        $this->assertEquals(sprintf('%s/', WebserviceClientBuilder::PRODUCTION_WEBSERVICE_URL), $wsClient->getBaseUrl());
    }

    public function testBuildSetsCorrectlyHostWhenFilled(): void
    {
        $username = $this->getFaker()->userName;
        $password = $this->getFaker()->password;
        $devHost = 'http://host.docker.internal:3006/api';

        $wsClient = WebserviceClientBuilder::build(
            $username,
            $password,
            $devHost
        );

        $this->assertEquals(sprintf('%s/', $devHost), $wsClient->getBaseUrl());
    }
}
