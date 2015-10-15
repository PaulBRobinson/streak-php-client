<?php

namespace spec\Streak\Endpoint;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Streak\Client;

class NewsfeedSpec extends ObjectBehavior
{
    function let(Client $client)
    {
        $this->beConstructedWith($client);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Streak\Endpoint\Newsfeed');
    }

    function it_should_restrict_detail_level_for_pipeline()
    {
        $this->shouldThrow('\InvalidArgumentException')->during('pipeline', [Argument::type('string'), 'invalidDetailField']);
    }

    function it_should_get_pipeline_newsfeed(Client $client)
    {
        $client->get(Argument::type('string'), [])->shouldBeCalled();
        $this->pipeline(Argument::type('string'));
    }

    function it_should_allow_to_specify_detail_for_pipeline(Client $client)
    {
        $detailLevel = 'ALL';

        $client->get(Argument::type('string'), [
            'query' => [
                'detailLevel' => $detailLevel,
            ],
        ]);

        $this->pipeline(Argument::type('string'), $detailLevel);
    }

    function it_should_restrict_detail_level_for_box()
    {
        $this->shouldThrow('\InvalidArgumentException')->during('box', [Argument::type('string'), 'invalidDetailField']);
    }

    function it_should_get_box_newsfeed(Client $client)
    {
        $client->get(Argument::type('string'), [])->shouldBeCalled();
        $this->box(Argument::type('string'));
    }

    function it_should_allow_to_specify_detail_for_box(Client $client)
    {
        $detailLevel = 'ALL';

        $client->get(Argument::type('string'), [
            'query' => [
                'detailLevel' => $detailLevel,
            ],
        ]);

        $this->box(Argument::type('string'), $detailLevel);
    }

    function it_should_restrict_detail_level_for_all()
    {
        $this->shouldThrow('\InvalidArgumentException')->during('all', ['invalidDetailField']);
    }

    function it_should_get_all_newsfeed(Client $client)
    {
        $client->get(Argument::type('string'), [])->shouldBeCalled();
        $this->all();
    }

    function it_should_allow_to_specify_detail_for_all(Client $client)
    {
        $detailLevel = 'ALL';

        $client->get(Argument::type('string'), [
            'query' => [
                'detailLevel' => $detailLevel,
            ],
        ]);

        $this->all($detailLevel);
    }
}
