<?php

namespace Streak\Endpoint;

use Streak\Client;

abstract class AbstractEndpoint
{
    protected $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }
}
