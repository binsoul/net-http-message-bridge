<?php

declare (strict_types = 1);

namespace BinSoul\Bridge\Http\Message;

use Psr\Http\Message\StreamInterface;

/**
 * Builds instances of the PSR-7 StreamInterface.
 */
interface StreamFactory
{
    /**
     * Builds a stream for the given name with the desired access mode.
     *
     * @param string $uri  uri of the resource
     * @param string $mode desired access mode
     *
     * @return StreamInterface
     */
    public function build(string $uri, string $mode): StreamInterface;
}
