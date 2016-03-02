<?php

namespace spec\Streak;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use GuzzleHttp\ClientInterface;
use Psr\Http\Message\ResponseInterface;

class ClientSpec extends ObjectBehavior
{
    function let(ClientInterface $handler)
    {
        $this->beConstructedWith($handler);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Streak\Client');
    }

    function it_should_get_an_url(ClientInterface $handler, ResponseInterface $response)
    {
        $handler->request('GET', 'foo', [])->shouldBeCalled();
        $handler->request('GET', 'foo', [])->willReturn($response);
        $this->get('foo');
    }

    function it_should_put_an_url(ClientInterface $handler, ResponseInterface $response)
    {
        $options = ['body' => 'foo'];
        $handler->request('PUT', 'foo', $options)->shouldBeCalled();
        $handler->request('PUT', 'foo', $options)->willReturn($response);
        $this->put('foo', $options);
    }

    function it_should_delete_an_url(ClientInterface $handler, ResponseInterface $response)
    {
        $handler->request('DELETE', 'foo', [])->shouldBeCalled();
        $handler->request('DELETE', 'foo', [])->willReturn($response);
        $this->delete('foo');
    }

    function it_should_post_an_url(ClientInterface $handler, ResponseInterface $response)
    {
        $options = ['body' => 'foo'];
        $handler->request('POST', 'foo', $options)->shouldBeCalled();
        $handler->request('POST', 'foo', $options)->willReturn($response);
        $response->getBody()->shouldBeCalled();
        $this->post('foo', $options);
    }

    function it_should_get_a_raw_response(ClientInterface $handler, ResponseInterface $response)
    {
        $handler->request('GET', 'foo', [])->shouldBeCalled();
        $handler->request('GET', 'foo', [])->willReturn($response);
        $response->getBody()->shouldBeCalled();
        $this->get('foo', [], false);
    }
}
