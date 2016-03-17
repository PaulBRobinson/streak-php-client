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

    /**
     * Shortcut to make a GET request
     *
     * @return array|string
     */
    public function get($path, array $options = [], $withJson = true)
    {
        return $this->sendRequest('GET', $path, $options, $withJson);
    }

    /**
     * Shortcut to make a PUT request
     *
     * @return array
     */
    public function put($path, array $options = [])
    {
        return $this->sendRequest('PUT', $path, $options);
    }

    /**
     * Shortcut to make a DELETE request
     *
     * @return boolean
     */
    public function delete($path, array $options = [])
    {
        $response = $this->sendRequest('DELETE', $path, $options);

        return $response['success'];
    }

    /**
     * Shortcut to make a POST request
     *
     * @return array
     */
    public function post($path, array $options = [])
    {
        return $this->sendRequest('POST', $path, $options);
    }

    /**
     * Make the HTTP request through the handler
     *
     * @return array|string
     */
    public function sendRequest($method, $path, array $options = [], $withJson = true)
    {
        $response = $this->handler->request($method, $path, $options);

        $body = (string)$response->getBody();

        return $withJson ? json_decode($body, true) : $body;
    }
}
