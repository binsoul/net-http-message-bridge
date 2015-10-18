<?php

namespace BinSoul\Test\Bridge\Http\Message;

use BinSoul\Bridge\Http\Message\Stream;
use BinSoul\IO\Stream\Stream as IoStream;

class StreamTest extends AbstractStreamTest
{

    protected function createStream(IoStream $stream, $accessMode)
    {
        return new Stream($stream, $accessMode);
    }
}
