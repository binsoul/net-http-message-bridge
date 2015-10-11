<?php

namespace BinSoul\Test\Bridge\Http\Message;

use BinSoul\Bridge\Http\Message\DefaultStreamFactory;
use Psr\Http\Message\StreamInterface;

class DefaultStreamFactoryTest extends \PHPUnit_Framework_TestCase
{
    public function test_creates_streams()
    {
        $factory = new DefaultStreamFactory();
        $stream = $factory->build('php://memory', 'r');

        $this->assertInstanceOf(StreamInterface::class, $stream);
        $this->assertFalse($stream->isWritable());
    }
}
