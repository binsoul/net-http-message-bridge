<?php

namespace BinSoul\Test\Bridge\Http\Message;

use BinSoul\Bridge\Http\Message\DefaultUriFactory;
use Psr\Http\Message\UriInterface;

class DefaultUriFactoryTest extends \PHPUnit_Framework_TestCase
{
    public function test_creates_uris()
    {
        $factory = new DefaultUriFactory();
        $uri = $factory->build('http://www.example.com');

        $this->assertInstanceOf(UriInterface::class, $uri);
        $this->assertEquals('http://www.example.com', (string) $uri);
    }
}
