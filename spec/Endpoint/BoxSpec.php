<?php

namespace spec\Streak\Endpoint;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Streak\Client;

class BoxSpec extends ObjectBehavior
{
    function let(Client $client)
    {
        $this->beConstructedWith($client);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Streak\Endpoint\Box');
    }

    function it_should_allow_specific_order_fields()
    {
        $this->shouldThrow('\InvalidArgumentException')->during('findAll', [Argument::type('string'), 'invalidSortField']);
    }

    function it_should_check_required_fields()
    {
        $this->shouldThrow('\InvalidArgumentException')->during('create', [Argument::type('string'), []]);
    }

    function it_should_check_allowed_field()
    {
        $this->shouldThrow('\InvalidArgumentException')->during('edit', [Argument::type('string'), ['unallowedField' => 'value']]);
    }

    function if_should_list_all_boxes(Client $client)
    {
        $client->get(Argument::type('string'))->shouldBeCalled();
        $this->all();
    }

    function it_should_find_all_boxes(Client $client)
    {
        $client->get(Argument::type('string'), [
            'query' => [
                'page'  => 1,
                'limit' => 500,
            ],
        ])->shouldBeCalled();
        $this->findAll(Argument::type('string'));
    }

    function it_should_find_all_boxes_with_sort_order(Client $client)
    {
        $sortBy = 'creationTimestamp';

        $client->get(Argument::type('string'), [
            'query' => [
                'sortBy' => $sortBy,
                'page'   => 1,
                'limit'  => 500,
            ],
        ])->shouldBeCalled();

        $this->findAll(Argument::type('string'), $sortBy);
    }

    function it_should_create_a_box(Client $client)
    {
        $client->put(Argument::type('string'), Argument::type('array'))->shouldBeCalled();
        $this->create(Argument::type('string'), ['name' => Argument::type('string')]);
    }

    function it_should_detele_a_box(Client $client)
    {
        $client->delete(Argument::type('string'))->shouldBeCalled();
        $client->delete(Argument::type('string'))->willReturn(true);
        $this->delete(Argument::type('string'))->shouldReturn(true);
    }

    function it_should_edit_a_box(Client $client)
    {
        $client->post(Argument::type('string'), Argument::type('array'))->shouldBeCalled();
        $this->edit(Argument::type('string'), ['name' => Argument::type('string')]);
    }

    function it_should_find_a_box(Client $client)
    {
        $client->get(Argument::type('string'))->shouldBeCalled();
        $this->find(Argument::type('string'));
    }
}
