<?php

namespace BinSoul\Bridge\Http\Message;

/**
 * Builds instances of the Uri class.
 */
class DefaultUriFactory implements UriFactory
{
    public function build($uri)
    {
        return Uri::parse($uri);
    }
}
