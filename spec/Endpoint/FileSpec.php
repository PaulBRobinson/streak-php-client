<?php

namespace spec\Streak\Endpoint;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Streak\Client;

class FileSpec extends ObjectBehavior
{
    function let(Client $client)
    {
        $this->beConstructedWith($client);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Streak\Endpoint\File');
    }

    function it_should_find_all_files_for_a_box(Client $client)
    {
        $client->get(Argument::type('string'))->shouldBeCalled();
        $this->findAll(Argument::type('string'));
    }

    function it_should_find_a_file(Client $client)
    {
        $client->get(Argument::type('string'))->shouldBeCalled();
        $this->find(Argument::type('string'));
    }

    function it_should_get_a_file_contents(Client $client)
    {
        $client->get(Argument::type('string'), [], false)->shouldBeCalled();
        $this->getContents(Argument::type('string'));
    }

    function it_should_get_a_file_link(Client $client)
    {
        $client->get(Argument::type('string'), [], false)->shouldBeCalled();
        $this->getLink(Argument::type('string'));
    }
}
