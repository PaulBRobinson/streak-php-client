<?php

namespace spec\Streak;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class StreakSpec extends ObjectBehavior
{
    function let($apiKey)
    {
        $this->beConstructedWith($apiKey);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Streak\Streak');
    }

    function it_gets_users()
    {
        $this->users()->shouldHaveType('Streak\Endpoint\User');
    }

    function it_gets_pipelines()
    {
        $this->pipelines()->shouldHaveType('Streak\Endpoint\Pipeline');
    }

    function it_gets_boxes()
    {
        $this->boxes()->shouldHaveType('Streak\Endpoint\Box');
    }

    function it_gets_stages()
    {
        $this->stages(Argument::type('string'))->shouldHaveType('Streak\Endpoint\Stage');
    }

    function it_gets_fields()
    {
        $this->fields(Argument::type('string'))->shouldHaveType('Streak\Endpoint\Field');
    }

    function it_gets_tasks()
    {
        $this->tasks()->shouldHaveType('Streak\Endpoint\Task');
    }
}
