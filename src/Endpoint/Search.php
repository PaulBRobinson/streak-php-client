<?php

namespace Streak\Endpoint;

class Search extends AbstractEndpoint
{
    const ENDPOINT = 'search';

    public function query($query)
    {
        return $this->client->get(self::ENDPOINT, [
            'query' => [
                'query' => $query,
            ],
        ]);
    }
}
