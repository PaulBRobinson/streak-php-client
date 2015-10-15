<?php

namespace spec\Streak\Endpoint;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Streak\Client;

class ThreadSpec extends ObjectBehavior
{
    function let(Client $client)
    {
        $this->beConstructedWith($client);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Streak\Endpoint\Thread');
    }

    function it_should_find_all_threads_for_a_box(Client $client)
    {
        $client->get(Argument::type('string'))->shouldBeCalled();
        $this->findAll(Argument::type('string'));
    }

    function it_should_find_a_thread(Client $client)
    {
        $client->get(Argument::type('string'))->shouldBeCalled();
        $this->find(Argument::type('string'));
    }
}
