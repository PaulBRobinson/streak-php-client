<?php

namespace spec\Streak\Endpoint;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Streak\Client;

class PipelineSpec extends ObjectBehavior
{
    function let(Client $client)
    {
        $this->beConstructedWith($client);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Streak\Endpoint\Pipeline');
    }

    function it_should_allow_specific_order_fields()
    {
        $this->shouldThrow('\InvalidArgumentException')->during('all', ['invalidSortField']);
    }

    function it_should_check_required_fields()
    {
        $this->shouldThrow('\InvalidArgumentException')->during('create', [[]]);
    }

    function it_should_check_allowed_field()
    {
        $this->shouldThrow('\InvalidArgumentException')->during('edit', [Argument::type('string'), ['unallowedField' => 'value']]);
    }

    function it_should_find_all_pipelines(Client $client)
    {
        $client->get(Argument::type('string'), [])->shouldBeCalled();
        $this->all();
    }

    function it_should_find_all_pipelines_with_sort_order(Client $client)
    {
        $sortBy = 'creationTimestamp';

        $client->get(Argument::type('string'), [
            'query' => [
                'sortBy' => $sortBy,
            ],
        ])->shouldBeCalled();

        $this->all($sortBy);
    }

    function it_should_find_a_pipeline(Client $client)
    {
        $client->get(Argument::type('string'))->shouldBeCalled();
        $this->find(Argument::type('string'));
    }

    function it_should_create_pipeline(Client $client)
    {
        $pipeline = [
            'name' => 'foo',
            'description' => 'bar',
        ];

        $client->put(Argument::type('string'), [
            'body' => $pipeline,
        ])->shouldBeCalled();

        $this->create($pipeline);
    }

    function it_should_delete_a_pipeline(Client $client)
    {
        $client->delete(Argument::type('string'))->shouldBeCalled();
        $this->delete(Argument::type('string'));
    }

    function it_should_edit_a_pipeline(Client $client)
    {
        $pipeline = [
            'name' => 'bar',
        ];

        $client->post(Argument::type('string'), [
            'json' => $pipeline,
        ])->shouldBeCalled();

        $this->edit(Argument::type('string'), $pipeline);
    }
}
