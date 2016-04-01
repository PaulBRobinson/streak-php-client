<?php

namespace spec\Streak\Endpoint;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Streak\Client;

class TaskSpec extends ObjectBehavior
{
    function let(Client $client)
    {
        $this->beConstructedWith($client);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Streak\Endpoint\Task');
    }

    function it_should_check_allowed_field()
    {
        $this->shouldThrow('\InvalidArgumentException')->during('edit', [Argument::type('string'), ['unallowedField' => 'value']]);
    }

    function it_should_get_all_tasks_for_a_box(Client $client)
    {
        $client->get(Argument::type('string'))->shouldBeCalled();
        $this->findAll(Argument::type('string'));
    }

    function it_should_get_a_task(Client $client)
    {
        $client->get(Argument::type('string'))->shouldBeCalled();
        $this->find(Argument::type('string'));
    }

    function it_should_create_a_task(Client $client)
    {
        $text = 'foo';
        $dueDate = time();

        $client->post(Argument::type('string'), [
            'form_params' => [
                'text' => $text,
                'dueDate' => $dueDate,
            ],
        ])->shouldBeCalled();

        $this->create(Argument::type('string'), $text, $dueDate);
    }

    function it_should_delete_a_task(Client $client)
    {
        $client->delete(Argument::type('string'))->shouldBeCalled();
        $client->delete(Argument::type('string'))->willReturn(true);
        $this->delete(Argument::type('string'))->shouldReturn(true);
    }

    function it_should_edit_a_task(Client $client)
    {
        $task = [
            'dueDate' => time(),
            'text' => 'bar',
        ];

        $client->post(Argument::type('string'), [
            'json' => $task,
        ])->shouldBeCalled();

        $this->edit(Argument::type('string'), $task);
    }
}
