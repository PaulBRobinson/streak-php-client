<?php

namespace Streak\Endpoint;

class Task extends AbstractEndpoint
{
    const ENDPOINT = 'tasks';

    public function findAll($boxKey)
    {
        return $this->client->get(sprintf('/api/v2/boxes/%s/%s', $boxKey, self::ENDPOINT));
    }

    public function find($taskKey)
    {
        return $this->client->get(sprintf('/api/v2/%s/%s', self::ENDPOINT, $taskKey));
    }

    public function create($boxKey, $text, $dueDate)
    {
        return $this->client->post(sprintf('/api/v2/boxes/%s/%s', $boxKey, self::ENDPOINT), [
            'form_params' => [
                'text' => $text,
                'dueDate' => $dueDate,
            ],
        ]);
    }

    public function delete($taskKey)
    {
        return $this->client->delete(sprintf('api/v2/%s/%s', self::ENDPOINT, $taskKey));
    }

    public function edit($taskKey, array $task)
    {
        foreach ($task as $field => $value) {
            if (!in_array($field, ['text', 'dueDate', 'assignedToSharingEntries'])) {
                throw new \InvalidArgumentException('Not allowed field.');
            }
        }

        return $this->client->post(sprintf('/api/v2/%s/%s', self::ENDPOINT, $taskKey), [
            'json' => $task,
        ]);
    }
}
