<?php

namespace spec\Streak\Endpoint;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Streak\Client;
use Streak\Endpoint\Snippet;

class SnippetSpec extends ObjectBehavior
{
    function let(Client $client)
    {
        $this->beConstructedWith($client);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Streak\Endpoint\Snippet');
    }

    function it_should_get_all_snippets(Client $client)
    {
        $client->get(Snippet::ENDPOINT)->shouldBeCalled();
        $this->all();
    }

    function it_should_find_a_snippet(Client $client)
    {
        $client->get(Argument::type('string'))->shouldBeCalled();
        $this->find(Argument::type('string'));
    }
}
