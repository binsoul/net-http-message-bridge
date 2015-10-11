<?php

namespace BinSoul\Bridge\Http\Message;

use Psr\Http\Message\UriInterface;

/**
 * Builds instances of the PSR-7 UriInterface.
 */
interface UriFactory
{
    /**
     * Builds an URI for the given string.
     *
     * @param string $uri
     *
     * @return UriInterface
     */
    public function build($uri);
}
