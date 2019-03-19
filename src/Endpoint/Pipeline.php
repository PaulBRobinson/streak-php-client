<?php

namespace Streak\Endpoint;

class Pipeline extends AbstractEndpoint
{
    const ENDPOINT = 'pipelines';

    public function all($sortBy = null)
    {
        $options = [];

        if (null !== $sortBy) {
            if (!in_array($sortBy, ['creationTimestamp', 'lastUpdatedTimestamp'])) {
                throw new \InvalidArgumentException('Invalid sort field.');
            }

            $options['query'] = ['sortBy' => $sortBy];
        }

        return $this->client->get('v1/'.self::ENDPOINT, $options);
    }

    public function find($pipelineKey)
    {
        return $this->client->get(sprintf('%s/%s/%s', 'v1', self::ENDPOINT, $pipelineKey));
    }

    public function create(array $pipeline)
    {
        if (!isset($pipeline['name']) || !isset($pipeline['description'])) {
            throw new \InvalidArgumentException('Missing required fields.');
        }

        return $this->client->put('v1/'.self::ENDPOINT, [
            'form_params' => $pipeline,
        ]);
    }

    public function delete($pipelineKey)
    {
        return $this->client->delete(sprintf('%s/%s/%s', 'v1', self::ENDPOINT, $pipelineKey));
    }

    public function edit($pipelineKey, array $pipeline)
    {
        foreach ($pipeline as $field => $value) {
            if (!in_array($field, ['name', 'description', 'stageOrder', 'orgWide', 'aclEntries'])) {
                throw new \InvalidArgumentException('Not allowed field.');
            }
        }

        return $this->client->post(sprintf('%s/%s/%s', 'v1', self::ENDPOINT, $pipelineKey), [
            'json' => $pipeline,
        ]);
    }
}
