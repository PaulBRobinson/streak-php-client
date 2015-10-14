<?php

namespace spec\Streak\Endpoint;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Streak\Client;
use Streak\Endpoint\User;

class UserSpec extends ObjectBehavior
{
    function let(Client $client)
    {
        $this->beConstructedWith($client);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Streak\Endpoint\User');
    }

    function it_should_get_myself(Client $client)
    {
        $client->get(User::ENDPOINT.'/me')->shouldBeCalled();
        $this->me();
    }

    function it_should_find_a_user(Client $client)
    {
        $client->get(Argument::type('string'))->shouldBeCalled();
        $this->find(Argument::type('string'));
    }
}
