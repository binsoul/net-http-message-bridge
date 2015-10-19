<?php

namespace BinSoul\Test\Bridge\Http\Message;

use BinSoul\Bridge\Http\Message\Stream;
use BinSoul\Bridge\Http\Message\StreamDecorator;
use BinSoul\IO\Stream\Stream as IoStream;
use Psr\Http\Message\StreamInterface;

class StreamDecoratorImplementation implements StreamInterface
{
    use StreamDecorator;
}

class StreamDecoratorTest extends AbstractStreamTest
{

    protected function createStream(IoStream $stream, $accessMode)
    {
        return new StreamDecoratorImplementation(new Stream($stream, $accessMode));
    }
}
