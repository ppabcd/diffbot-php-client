<?php

namespace Swader\Diffbot\Test\Api;

use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use Http\Adapter\Guzzle6\Client as Guzzle6;
use Http\Client\Common\HttpMethodsClient;
use Http\Discovery\MessageFactoryDiscovery;
use Swader\Diffbot\Diffbot;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Psr7\Response;

trait setterUpper
{

    protected function getValidDiffbotInstance()
    {
        return new Diffbot('demo');
    }


    public function preSetUp()
    {
        $diffbot = $this->getValidDiffbotInstance();

        $handler = HandlerStack::create($this->getValidMock());
        $guzzleClient = new Client(['handler' => $handler]);

        $methodsClient = new HttpMethodsClient(
            new Guzzle6($guzzleClient),
            MessageFactoryDiscovery::find());

        $diffbot->setHttpClient($methodsClient);
        $diffbot->setEntityFactory();

        return $diffbot;
    }

    public function getCustomMockFakeClient($filepath, $code = 200)
    {
        $handler = HandlerStack::create(new MockHandler([
            new Response($code, [],
                file_get_contents($filepath))
        ]));

        $guzzleClient = new Client(['handler' => $handler]);

        return new HttpMethodsClient(
            new Guzzle6($guzzleClient),
            MessageFactoryDiscovery::find());

    }
}
