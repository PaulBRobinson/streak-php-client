<?php

namespace spec\Streak\Endpoint;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Streak\Client;
use Streak\Endpoint\Field;

class FieldSpec extends ObjectBehavior
{
    const PIPELINEKEY = 'foo';

    function let(Client $client)
    {
        $this->beConstructedWith($client, self::PIPELINEKEY);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Streak\Endpoint\Field');
    }

    function it_should_check_field_type()
    {
        $this->shouldThrow('InvalidArgumentException')->during('create', [Argument::type('string'), 'invalidType']);
    }

    function it_should_find_all_fields(Client $client)
    {
        $client->get(Argument::type('string'))->shouldBeCalled();
        $this->findAll();
    }

    function it_should_find_a_field(Client $client)
    {
        $client->get(Argument::type('string'))->shouldBeCalled();
        $this->find(Argument::type('string'));
    }

    function it_should_create_a_field(Client $client)
    {
        $name = 'foo';
        $type = Field::TYPE_TEXT;

        $client->put(Argument::type('string'), [
            'body' => [
                'name' => $name,
                'type' => $type,
            ],
        ])->shouldBeCalled();

        $this->create($name, $type);
    }

    function it_should_delete_a_field(Client $client)
    {
        $client->delete(Argument::type('string'))->shouldBeCalled();
        $this->delete(Argument::type('string'));
    }

    function it_should_edit_a_field(Client $client)
    {
        $name = 'bar';

        $client->post(Argument::type('string'), [
            'json' => [
                'name' => $name,
            ],
        ])->shouldBeCalled();

        $this->edit(Argument::type('string'), $name);
    }

    function it_should_get_box_values(Client $client)
    {
        $client->get(Argument::type('string'))->shouldBeCalled();
        $this->values(Argument::type('string'));
    }

    function it_should_get_a_field_value(Client $client)
    {
        $client->get(Argument::type('string'))->shouldBeCalled();
        $this->getValue(Argument::type('string'), Argument::type('string'));
    }

    function it_should_set_a_value(Client $client)
    {
        $value = 'foo';

        $client->post(Argument::type('string'), [
            'json' => [
                'value' => $value,
            ],
        ])->shouldBeCalled();

        $this->setValue(Argument::type('string'), Argument::type('string'), $value);
    }
}
