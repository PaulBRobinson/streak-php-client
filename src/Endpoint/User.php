<?php

namespace Streak\Endpoint;

class User extends AbstractEndpoint
{
    const ENDPOINT = 'users';

    public function me()
    {
        return $this->client->get('v1/'.self::ENDPOINT.'/me');
    }

    public function find($userKey)
    {
        return $this->client->get(sprintf('%s/%s/%s', 'v1', self::ENDPOINT, $userKey));
    }

    public function teams()
    {
      return $this->client->get('v2/'.self::ENDPOINT.'/me/teams');
    }
}
