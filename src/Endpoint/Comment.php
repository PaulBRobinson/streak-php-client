<?php

namespace Streak\Endpoint;

class Comment extends AbstractEndpoint
{
    const ENDPOINT = 'comments';

    public function create($boxKey, $message)
    {
        return $this->client->put(sprintf('boxes/%s/%s', $boxKey, self::ENDPOINT), [
            'form_params' => [
                'message' => $message,
            ],
        ]);
    }
}
