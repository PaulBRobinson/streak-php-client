<?php

namespace Streak\Endpoint;

class Snippet extends AbstractEndpoint
{
    const ENDPOINT = 'snippets';

    public function all()
    {
        return $this->client->get(self::ENDPOINT);
    }

    public function find($snippetKey)
    {
        return $this->client->get(sprintf('%s/%s', self::ENDPOINT, $snippetKey));
    }
}
