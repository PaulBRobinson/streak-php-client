<?php

namespace Streak\Endpoint;

use Streak\Client;

abstract class TeamEndpoint extends AbstractEndpoint
{
    protected $teamKey;

    public function __construct(Client $client, $teamKey)
    {
        $this->client = $client;
        $this->teamKey = $teamKey;
    }
}
