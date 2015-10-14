<?php

namespace Streak;

use GuzzleHttp\Client as GuzzleClient;
use Streak\Endpoint\User;
use Streak\Endpoint\Pipeline;
use Streak\Endpoint\Box;
use Streak\Endpoint\Stage;
use Streak\Endpoint\Field;

class Streak
{
    const BASE_URL = 'https://www.streak.com/api/v1/';

    protected $client;

    public function __construct($apiKey)
    {
        $handler = new GuzzleClient([
            'base_url' => self::BASE_URL,
            'defaults' => [
                'auth' => [$apiKey],
                'headers' => [
                    'Content-Type' => 'application/json',
                ],
            ],
        ]);

        $this->client = new Client($handler);
    }

    public function users()
    {
        return new User($this->client);
    }

    public function pipelines()
    {
        return new Pipeline($this->client);
    }

    public function boxes()
    {
        return new Box($this->client);
    }

    public function stages($pipelineKey)
    {
        return new Stage($this->client, $pipelineKey);
    }

    public function fields($pipelineKey)
    {
        return new Field($this->client, $pipelineKey);
    }
}
