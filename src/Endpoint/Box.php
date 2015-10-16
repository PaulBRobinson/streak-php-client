<?php

namespace Streak\Endpoint;

class Box extends AbstractEndpoint
{
    const ENDPOINT = 'boxes';

    public function all()
    {
        return $this->client->get(self::ENDPOINT);
    }

    public function findAll($pipelineKey, $sortBy = null)
    {
        $options = [];

        if (null !== $sortBy) {
            if (!in_array($sortBy, ['creationTimestamp', 'lastUpdatedTimestamp'])) {
                throw new \InvalidArgumentException('Invalid sort field.');
            }

            $options['query'] = ['sortBy' => $sortBy];
        }

        return $this->client->get(sprintf('pipelines/%s/%s', $pipelineKey, self::ENDPOINT), $options);
    }

    public function create($pipelineKey, array $box)
    {
        if (!isset($box['name'])) {
            throw new \InvalidArgumentException('Missing required fields.');
        }

        return $this->client->put(sprintf('pipelines/%s/%s', $pipelineKey, self::ENDPOINT), [
            'body' => $box,
        ]);
    }

    public function delete($boxKey)
    {
        return $this->client->delete(sprintf('%s/%s', self::ENDPOINT, $boxKey));
    }

    public function edit($boxKey, array $box)
    {
        foreach ($box as $field => $value) {
            if (!in_array($field, ['name', 'notes', 'stageKey', 'followerKeys', 'fields'])) {
                throw new \InvalidArgumentException('Not allowed field.');
            }
        }

        return $this->client->post(sprintf('%s/%s', self::ENDPOINT, $boxKey), [
            'json' => $box,
        ]);
    }

    public function find($boxKey)
    {
        return $this->client->get(sprintf('%s/%s', self::ENDPOINT, $boxKey));
    }
}
