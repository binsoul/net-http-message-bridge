<?php

namespace BinSoul\Bridge\Http\Message;

use BinSoul\Net\URI as NetURI;
use Psr\Http\Message\UriInterface;

/**
 * Extends the Net\URI class to implement the PSR-7 UriInterface.
 */
class Uri extends NetURI implements UriInterface
{
}
