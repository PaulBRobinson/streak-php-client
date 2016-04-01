<?php

namespace Streak\Endpoint;

class Stage extends PipelineEndpoint
{
    const ENDPOINT = 'stages';

    public function findAll()
    {
        return $this->client->get(sprintf('pipelines/%s/%s', $this->pipelineKey, self::ENDPOINT));
    }

    public function find($stageKey)
    {
        return $this->client->get(sprintf('pipelines/%s/%s/%s', $this->pipelineKey, self::ENDPOINT, $stageKey));
    }

    public function create($name)
    {
        return $this->client->put(sprintf('pipelines/%s/%s', $this->pipelineKey, self::ENDPOINT), [
            'form_params' => [
                'name' => $name,
            ],
        ]);
    }

    public function delete($stageKey)
    {
        return $this->client->delete(sprintf('pipelines/%s/%s/%s', $this->pipelineKey, self::ENDPOINT, $stageKey));
    }

    public function edit($stageKey, $name)
    {
        return $this->client->post(sprintf('pipelines/%s/%s/%s', $this->pipelineKey, self::ENDPOINT, $stageKey), [
            'json' => [
                'name' => $name,
            ],
        ]);
    }
}
