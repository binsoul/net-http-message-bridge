<?php

namespace BinSoul\Bridge\Http\Message;

use Psr\Http\Message\StreamInterface;

/**
 * Implements the StreamInterface interface and delegates all methods to the decorated stream.
 */
trait StreamDecorator
{
    /** @var StreamInterface */
    protected $decorated;

    public function __toString()
    {
        return $this->decorated->__toString();
    }

    public function detach()
    {
        return $this->decorated->detach();
    }

    public function close()
    {
        $this->decorated->close();
    }

    public function read($length)
    {
        return $this->decorated->read($length);
    }

    public function getContents()
    {
        return $this->decorated->getContents();
    }

    public function write($string)
    {
        return $this->decorated->write($string);
    }

    public function seek($offset, $whence = SEEK_SET)
    {
        return $this->decorated->seek($offset, $whence);
    }

    public function rewind()
    {
        return $this->decorated->rewind();
    }

    public function tell()
    {
        return $this->decorated->tell();
    }

    public function eof()
    {
        return $this->decorated->eof();
    }

    public function isSeekable()
    {
        return $this->decorated->isSeekable();
    }

    public function isWritable()
    {
        return $this->decorated->isWritable();
    }

    public function isReadable()
    {
        return $this->decorated->isReadable();
    }

    public function getSize()
    {
        return $this->decorated->getSize();
    }

    public function getMetadata($key = null)
    {
        return $this->decorated->getMetadata($key);
    }
}
