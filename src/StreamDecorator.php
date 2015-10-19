<?php

namespace BinSoul\Bridge\Http\Message;

use BinSoul\Common\Decorator;

/**
 * Implements the {@see \Psr\Http\Message\StreamInterface StreamInterface} interface and delegates
 * all methods to the decorated stream.
 */
trait StreamDecorator
{
    use Decorator;

    public function __toString()
    {
        return $this->decoratedObject->__toString();
    }

    public function detach()
    {
        return $this->decoratedObject->detach();
    }

    public function close()
    {
        $this->decoratedObject->close();
    }

    public function read($length)
    {
        return $this->decoratedObject->read($length);
    }

    public function getContents()
    {
        return $this->decoratedObject->getContents();
    }

    public function write($string)
    {
        return $this->decoratedObject->write($string);
    }

    public function seek($offset, $whence = SEEK_SET)
    {
        return $this->decoratedObject->seek($offset, $whence);
    }

    public function rewind()
    {
        return $this->decoratedObject->rewind();
    }

    public function tell()
    {
        return $this->decoratedObject->tell();
    }

    public function eof()
    {
        return $this->decoratedObject->eof();
    }

    public function isSeekable()
    {
        return $this->decoratedObject->isSeekable();
    }

    public function isWritable()
    {
        return $this->decoratedObject->isWritable();
    }

    public function isReadable()
    {
        return $this->decoratedObject->isReadable();
    }

    public function getSize()
    {
        return $this->decoratedObject->getSize();
    }

    public function getMetadata($key = null)
    {
        return $this->decoratedObject->getMetadata($key);
    }
}
