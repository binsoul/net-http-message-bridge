<?php

declare (strict_types = 1);

namespace BinSoul\Bridge\Http\Message;

use BinSoul\Net\URI as NetURI;
use Psr\Http\Message\UriInterface;

/**
 * Builds instances of the {@see Uri} class.
 */
class DefaultUriFactory implements UriFactory
{
    public function build(string $uri): UriInterface
    {
        return new Uri(NetURI::parse($uri));
    }
}
