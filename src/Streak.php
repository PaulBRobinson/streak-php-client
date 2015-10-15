<?php

namespace Streak;

use GuzzleHttp\Client as GuzzleClient;
use Streak\Endpoint\User;
use Streak\Endpoint\Pipeline;
use Streak\Endpoint\Box;
use Streak\Endpoint\Stage;
use Streak\Endpoint\Field;
use Streak\Endpoint\Task;
use Streak\Endpoint\File;
use Streak\Endpoint\Thread;
use Streak\Endpoint\Comment;
use Streak\Endpoint\Snippet;
use Streak\Endpoint\Search;
use Streak\Endpoint\Newsfeed;
use GuzzleHttp\ClientInterface;

class Streak
{
    const BASE_URL = 'https://www.streak.com/api/{version}/';
    const VERSION = 'v1';

    protected $client;

    public function __construct($apiKey, array $config = [])
    {
        if (isset($config['handler'])) {
            if ($config['handler'] instanceof ClientInterface) {
                $handler = $config['handler'];
            } else {
                throw new \InvalidArgumentException('The handler should be an instance of "GuzzleHttp\ClientInterface".');
            }
        } else {
            $handler = new GuzzleClient([
                'base_url' => [self::BASE_URL, ['version' => self::VERSION]],
                'defaults' => [
                    'auth' => [$apiKey],
                ],
            ]);
        }

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

    public function tasks()
    {
        return new Task($this->client);
    }

    public function files()
    {
        return new File($this->client);
    }

    public function threads()
    {
        return new Thread($this->client);
    }

    public function comments()
    {
        return new Comment($this->client);
    }

    public function snippets()
    {
        return new Snippet($this->client);
    }

    public function search()
    {
        return new Search($this->client);
    }

    public function newsfeed()
    {
        return new Newsfeed($this->client);
    }
}
