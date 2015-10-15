<?php

namespace spec\Streak\Endpoint;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Streak\Client;
use Streak\Endpoint\Search;

class SearchSpec extends ObjectBehavior
{
    function let(Client $client)
    {
        $this->beConstructedWith($client);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Streak\Endpoint\Search');
    }

    function it_search_things(Client $client)
    {
        $query = 'foo';

        $client->get(Search::ENDPOINT, [
            'query' => [
                'query' => $query,
            ],
        ]);

        $this->query($query);
    }
}
