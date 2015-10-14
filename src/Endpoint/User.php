<?php

namespace Streak\Endpoint;

class User extends AbstractEndpoint
{
    const ENDPOINT = 'users';

    public function me()
    {
        return $this->client->get(self::ENDPOINT.'/me');
    }

    public function find($userKey)
    {
        return $this->client->get(sprintf('%s/%s', self::ENDPOINT, $userKey));
    }
}
