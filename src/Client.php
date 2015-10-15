<?php

namespace Streak;

use GuzzleHttp\ClientInterface;

class Client
{
    protected $handler;

    public function __construct(ClientInterface $handler)
    {
        $this->handler = $handler;
    }

    public function get($path, array $options = [], $withJson = true)
    {
        return $this->sendRequest('GET', $path, $options, $withJson);
    }

    public function put($path, array $options = [])
    {
        return $this->sendRequest('PUT', $path, $options);
    }

    public function delete($path, array $options = [])
    {
        $response = $this->sendRequest('DELETE', $path, $options);

        return $response['success'];
    }

    public function post($path, array $options = [])
    {
        return $this->sendRequest('POST', $path, $options);
    }

    public function sendRequest($method, $path, array $options = [], $withJson = true)
    {
        $response = $this->handler->send($this->handler->createRequest($method, $path, $options));

        return $withJson ? $response->json() : (string) $response->getBody();
    }
}
