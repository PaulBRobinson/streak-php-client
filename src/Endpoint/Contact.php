<?php

namespace Streak\Endpoint;

class Contact extends TeamEndpoint
{
    const ENDPOINT = 'contacts';

    public function create($args, $getIfExists = false)
    {
        if (!array_key_exists('emailAddresses', $args)) {
            throw new \InvalidArgumentException('Must provide Email.');
        }

        return $this->client->post(sprintf('%s/teams/%s/%s?getIfExisting=%s', 'v2', $this->teamKey, self::ENDPOINT, $getIfExists ? 'true' : 'false'), [
            'json' => $args,
        ]);
    }

    public function delete($contactKey)
    {
        return $this->client->delete(sprintf('%s/%s/%s', 'v2', self::ENDPOINT, $contactKey));
    }

    public function edit($contactKey, array $contact)
    {
        foreach ($contact as $field => $value) {
            if (!in_array($field, ['givenName', 'familyName', 'emailAddresses', 'title', 'other', 'addresses', 'phoneNumbers', 'twitterHandle', 'facebookHandle', 'linkedinHandle', 'photoUrl'])) {
                throw new \InvalidArgumentException('Not allowed field.');
            }
        }

        return $this->client->post(sprintf('%s/%s/%s', 'v2', self::ENDPOINT, $contactKey), [
            'json' => $box,
        ]);
    }

    public function find($contactKey)
    {
        return $this->client->get(sprintf('%s/%s/%s', 'v2', self::ENDPOINT, $contactKey));
    }
}
