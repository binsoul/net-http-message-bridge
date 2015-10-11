<?php

namespace BinSoul\Bridge\Http\Message;

use BinSoul\IO\Stream\Type\ResourceStream;

/**
 * Builds instances of the Stream class.
 */
class DefaultStreamFactory implements StreamFactory
{
    public function build($uri, $mode)
    {
        return new Stream(new ResourceStream($uri), $mode);
    }
}
