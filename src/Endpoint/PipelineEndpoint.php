<?php

namespace Streak\Endpoint;

use Streak\Client;

abstract class PipelineEndpoint extends AbstractEndpoint
{
    protected $pipelineKey;

    public function __construct(Client $client, $pipelineKey)
    {
        $this->client = $client;
        $this->pipelineKey = $pipelineKey;
    }
}
