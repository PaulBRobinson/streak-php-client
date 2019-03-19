<?php

namespace Streak\Endpoint;

class Field extends PipelineEndpoint
{
    const ENDPOINT = 'fields';

    const TYPE_TEXT = 'TEXT_INPUT';
    const TYPE_PERSON = 'PERSON';
    const TYPE_DATE = 'DATE';

    public function findAll()
    {
        return $this->client->get(sprintf('%s/pipelines/%s/%s', 'v1', $this->pipelineKey, self::ENDPOINT));
    }

    public function find($fieldKey)
    {
        return $this->client->get(sprintf('%s/pipelines/%s/%s/%s', 'v1', $this->pipelineKey, self::ENDPOINT, $fieldKey));
    }

    public function create($name, $type)
    {
        if (!in_array($type, [self::TYPE_TEXT, self::TYPE_PERSON, self::TYPE_DATE])) {
            throw new \InvalidArgumentException('Invalid Field type.');
        }

        return $this->client->put(sprintf('%s/pipelines/%s/%s', 'v1', $this->pipelineKey, self::ENDPOINT), [
            'form_params' => [
                'name' => $name,
                'type' => $type,
            ],
        ]);
    }

    public function delete($fieldKey)
    {
        return $this->client->delete(sprintf('%s/pipelines/%s/%s/%s', 'v1', $this->pipelineKey, self::ENDPOINT, $fieldKey));
    }

    public function edit($fieldKey, $name)
    {
        return $this->client->post(sprintf('%s/pipelines/%s/%s/%s', 'v1', $this->pipelineKey, self::ENDPOINT, $fieldKey), [
            'json' => [
                'name' => $name,
            ],
        ]);
    }

    public function values($boxKey)
    {
        return $this->client->get(sprintf('%s/boxes/%s/%s', 'v1', $boxKey, self::ENDPOINT));
    }

    public function getValue($boxKey, $fieldKey)
    {
        return $this->client->get(sprintf('%s/boxes/%s/%s/%s', 'v1', $boxKey, self::ENDPOINT, $fieldKey));
    }

    public function setValue($boxKey, $fieldKey, $value)
    {
        return $this->client->post(sprintf('%s/boxes/%s/%s/%s', 'v1', $boxKey, self::ENDPOINT, $fieldKey), [
            'json' => [
                'value' => $value,
            ],
        ]);
    }
}
