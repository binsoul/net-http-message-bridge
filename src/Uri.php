<?php

declare (strict_types = 1);

namespace BinSoul\Bridge\Http\Message;

use BinSoul\Net\URI as NetURI;
use Psr\Http\Message\UriInterface;

/**
 * Decorates the {@see \BinSoul\Net\URI Net\URI} class to implement the PSR-7 UriInterface.
 */
class Uri implements UriInterface
{
    /** @var NetURI */
    private $uri;

    /**
     * Constructs an instance of this class.
     *
     * @param NetURI $uri
     */
    public function __construct(NetURI $uri)
    {
        $this->uri = $uri;
    }

    public function getScheme()
    {
        return $this->uri->getScheme();
    }

    public function getAuthority()
    {
        return $this->uri->getAuthority();
    }

    public function getUserInfo()
    {
        return $this->uri->getUserInfo();
    }

    public function getHost()
    {
        return $this->uri->getHost();
    }

    public function getPort()
    {
        return $this->uri->getPort();
    }

    public function getPath()
    {
        return $this->uri->getPath();
    }

    public function getQuery()
    {
        return $this->uri->getQuery();
    }

    public function getFragment()
    {
        return $this->uri->getFragment();
    }

    public function withScheme($scheme)
    {
        return new static($this->uri->withScheme($scheme));
    }

    public function withUserInfo($user, $password = null)
    {
        return new static($this->uri->withUserInfo($user, $password));
    }

    public function withHost($host)
    {
        return new static($this->uri->withHost($host));
    }

    public function withPort($port)
    {
        return new static($this->uri->withPort($port));
    }

    public function withPath($path)
    {
        return new static($this->uri->withPath($path));
    }

    public function withQuery($query)
    {
        return new static($this->uri->withQuery($query));
    }

    public function withFragment($fragment)
    {
        return new static($this->uri->withFragment($fragment));
    }

    public function __toString()
    {
        return $this->uri->__toString();
    }
}
