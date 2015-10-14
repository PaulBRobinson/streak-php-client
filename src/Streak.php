<?php

namespace Streak;

use GuzzleHttp\Client as GuzzleClient;
use Streak\Endpoint\User;
use Streak\Endpoint\Pipeline;
use Streak\Endpoint\Box;
use Streak\Endpoint\Stage;
use Streak\Endpoint\Field;
use Streak\Endpoint\Task;

class Streak
{
    const BASE_URL = 'https://www.streak.com/api/{version}/';
    const VERSION = 'v1';

    protected $client;

    public function __construct($apiKey)
    {
        $handler = new GuzzleClient([
            'base_url' => [self::BASE_URL, ['version' => self::VERSION]],
            'defaults' => [
                'auth' => [$apiKey],
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
