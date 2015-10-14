<?php

namespace spec\Streak\Endpoint;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Streak\Client;

class StageSpec extends ObjectBehavior
{
    const PIPELINEKEY = 'foo';

    function let(Client $client)
    {
        $this->beConstructedWith($client, self::PIPELINEKEY);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Streak\Endpoint\Stage');
    }

    function it_should_find_all_stages(Client $client)
    {
        $client->get(Argument::type('string'))->shouldBeCalled();
        $this->findAll(Argument::type('string'));
    }

    function it_should_find_a_stage(Client $client)
    {
        $client->get(Argument::type('string'))->shouldBeCalled();
        $this->find(Argument::type('string'));
    }

    function it_should_create_a_stage(Client $client)
    {
        $name = 'foo';

        $client->put(Argument::type('string'), [
            'body' => [
                'name' => $name,
            ],
        ])->shouldBeCalled();

        $this->create($name);
    }

    function it_should_delete_a_stage(Client $client)
    {
        $client->delete(Argument::type('string'))->shouldBeCalled();
        $client->delete(Argument::type('string'))->willReturn(true);
        $this->delete(Argument::type('string'))->shouldReturn(true);
    }

    function it_should_edit_a_stage(Client $client)
    {
        $name = 'bar';

        $client->post(Argument::type('string'), [
            'json' => [
                'name' => $name,
            ],
        ])->shouldBeCalled();

        $this->edit(Argument::type('string'), $name);
    }
}
