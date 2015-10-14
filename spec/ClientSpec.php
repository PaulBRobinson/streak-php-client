<?php

namespace spec\Streak;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Message\RequestInterface;
use GuzzleHttp\Message\ResponseInterface;

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

    function it_should_get_an_url(ClientInterface $handler, RequestInterface $request, ResponseInterface $response)
    {
        $handler->createRequest('GET', 'foo', [])->willReturn($request);
        $handler->send($request)->shouldBeCalled();
        $handler->send($request)->willReturn($response);
        $this->get('foo');
    }

    function it_should_put_an_url(ClientInterface $handler, RequestInterface $request, ResponseInterface $response)
    {
        $options = ['body' => 'foo'];
        $handler->createRequest('PUT', 'foo', $options)->willReturn($request);
        $handler->send($request)->shouldBeCalled();
        $handler->send($request)->willReturn($response);
        $this->put('foo', $options);
    }

    function it_should_delete_an_url(ClientInterface $handler, RequestInterface $request, ResponseInterface $response)
    {
        $handler->createRequest('DELETE', 'foo', [])->willReturn($request);
        $handler->send($request)->shouldBeCalled();
        $handler->send($request)->willReturn($response);
        $this->delete('foo');
    }

    function it_should_post_an_url(ClientInterface $handler, RequestInterface $request, ResponseInterface $response)
    {
        $options = ['body' => 'foo'];
        $handler->createRequest('POST', 'foo', $options)->willReturn($request);
        $handler->send($request)->shouldBeCalled();
        $handler->send($request)->willReturn($response);
        $this->post('foo', $options);
    }
}
