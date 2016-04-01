<?php

namespace Streak\Endpoint;

use Streak\Paginator;

class Box extends AbstractEndpoint
{
    const ENDPOINT = 'boxes';

    public function all()
    {
        return $this->client->get(self::ENDPOINT);
    }

    public function findAll($pipelineKey, $sortBy = null, Paginator $paginator = null)
    {
        $options = ['query' => []];

        if (null !== $sortBy) {
            if (!in_array($sortBy, ['creationTimestamp', 'lastUpdatedTimestamp'])) {
                throw new \InvalidArgumentException('Invalid sort field.');
            }

            $options['query']['sortBy'] = $sortBy;
        }

        if (null === $paginator) {
            $paginator = new Paginator();
        }

        while ($paginator->nextPage()) {
            $options['query']['page'] = $paginator->getPage();
            $options['query']['limit'] = $paginator->getLimit();

            $results = $this->client->get(sprintf('pipelines/%s/%s', $pipelineKey, self::ENDPOINT), $options);

            $paginator->addResults($results);
        }

        return $paginator->getResults();
    }

    public function create($pipelineKey, array $box)
    {
        if (!isset($box['name'])) {
            throw new \InvalidArgumentException('Missing required fields.');
        }

        return $this->client->put(sprintf('pipelines/%s/%s', $pipelineKey, self::ENDPOINT), [
            'form_params' => $box,
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
