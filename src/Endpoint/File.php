<?php

namespace Streak\Endpoint;

class File extends AbstractEndpoint
{
    const ENDPOINT = 'files';

    public function findAll($boxKey)
    {
        return $this->client->get(sprintf('boxes/%s/%s', $boxKey, self::ENDPOINT));
    }

    public function find($fileKey)
    {
        return $this->client->get(sprintf('%s/%s', self::ENDPOINT, $fileKey));
    }

    public function getContents($fileKey)
    {
        return $this->client->get(sprintf('%s/%s/contents', self::ENDPOINT, $fileKey), [], false);
    }

    public function getLink($fileKey)
    {
        return $this->client->get(sprintf('%s/%s/link', self::ENDPOINT, $fileKey), [], false);
    }
}
