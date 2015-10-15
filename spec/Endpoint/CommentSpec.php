<?php

namespace spec\Streak\Endpoint;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Streak\Client;

class CommentSpec extends ObjectBehavior
{
    function let(Client $client)
    {
        $this->beConstructedWith($client);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Streak\Endpoint\Comment');
    }

    function it_should_create_a_comment(Client $client)
    {
        $message = 'foo';

        $client->put(Argument::type('string'), [
            'body' => [
                'message' => $message,
            ],
        ])->shouldBeCalled();

        $this->create(Argument::type('string'), $message);
    }
}
