<?php

namespace Streak\Endpoint;

class Newsfeed extends AbstractEndpoint
{
    const ENDPOINT = 'newsfeed';

    public function pipeline($pipelineKey, $detailLevel = null)
    {
        $options = [];

        if (null !== $detailLevel) {
            if (!in_array($detailLevel, ['ALL', 'CONDENSED'])) {
                throw new \InvalidArgumentException('Invalid detail field.');
            }

            $options['query'] = ['detailLevel' => $detailLevel];
        }

        return $this->client->get(sprintf('pipelines/%s/%s', $pipelineKey, self::ENDPOINT), $options);
    }

    public function box($boxKey, $detailLevel = null)
    {
        $options = [];

        if (null !== $detailLevel) {
            if (!in_array($detailLevel, ['ALL', 'CONDENSED'])) {
                throw new \InvalidArgumentException('Invalid detail field.');
            }

            $options['query'] = ['detailLevel' => $detailLevel];
        }

        return $this->client->get(sprintf('boxes/%s/%s', $boxKey, self::ENDPOINT), $options);
    }

    public function all($detailLevel = null)
    {
        $options = [];

        if (null !== $detailLevel) {
            if (!in_array($detailLevel, ['ALL', 'CONDENSED'])) {
                throw new \InvalidArgumentException('Invalid detail field.');
            }

            $options['query'] = ['detailLevel' => $detailLevel];
        }

        return $this->client->get(self::ENDPOINT, $options);
    }
}
