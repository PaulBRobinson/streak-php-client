<?php

namespace Streak\Endpoint;

class Thread extends AbstractEndpoint
{
    const ENDPOINT = 'threads';

    public function findAll($boxKey)
    {
        return $this->client->get(sprintf('boxes/%s/%s', $boxKey, self::ENDPOINT));
    }

    public function find($threadKey)
    {
        return $this->client->get(sprintf('%s/%s', self::ENDPOINT, $threadKey));
    }
}
