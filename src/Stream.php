<?php

declare (strict_types = 1);

namespace BinSoul\Bridge\Http\Message;

use BinSoul\IO\Stream\AccessMode;
use BinSoul\IO\Stream\Stream as IoStream;
use Psr\Http\Message\StreamInterface;

/**
 * Decorates the {@see \BinSoul\IO\Stream\Stream IO\Stream} class to implement the PSR-7 StreamInterface.
 */
class Stream implements StreamInterface
{
    /** @var IoStream */
    protected $stream;

    /**
     * Constructs an instance of this class.
     *
     * @param IoStream $stream
     * @param string   $mode   desired access mode
     */
    public function __construct(IoStream $stream, string $mode)
    {
        $stream->open(new AccessMode($mode));

        $this->stream = $stream;
    }

    public function __toString()
    {
        try {
            $this->rewind();

            return $this->getContents();
        } catch (\Exception $e) {
            return '';
        }
    }

    public function detach()
    {
        $this->assertAttached();

        $result = $this->stream->detach();
        $this->stream = null;

        return $result;
    }

    public function close()
    {
        $this->assertAttached();

        $this->stream->close();
    }

    public function read($length)
    {
        $this->assertAttached();

        $result = $this->stream->read($length);
        if ($result === false) {
            throw new \RuntimeException('An error occurred during the read operation.');
        }

        return $result;
    }

    public function getContents()
    {
        $result = '';
        while (!$this->eof()) {
            $result .= $this->read(1 * 1024 * 1024);
        }

        return $result;
    }

    public function write($string)
    {
        $this->assertAttached();

        $result = $this->stream->write($string);
        if ($result === false) {
            throw new \RuntimeException('An error occurred during the write operation.');
        }

        return $result;
    }

    public function seek($offset, $whence = SEEK_SET)
    {
        $this->assertAttached();

        if (!$this->stream->seek($offset, $whence)) {
            throw new \RuntimeException('An error occurred during the seek operation.');
        }

        return true;
    }

    public function rewind()
    {
        return $this->seek(0);
    }

    public function tell()
    {
        $this->assertAttached();

        $result = $this->stream->tell();
        if (!is_int($result)) {
            throw new \RuntimeException('An error occurred during the tell operation.');
        }

        return $result;
    }

    public function eof()
    {
        $this->assertAttached();

        return $this->stream->isEof();
    }

    public function isSeekable()
    {
        $this->assertAttached();

        return $this->stream->isSeekable();
    }

    public function isWritable()
    {
        $this->assertAttached();

        return $this->stream->isWritable();
    }

    public function isReadable()
    {
        $this->assertAttached();

        return $this->stream->isReadable();
    }

    public function getSize()
    {
        $this->assertAttached();

        return $this->stream->getSize();
    }

    public function getMetadata($key = null)
    {
        $this->assertAttached();

        return $this->stream->getMetadata($key);
    }

    /**
     * Asserts that the stream is attached.
     *
     * @throws \LogicException
     */
    private function assertAttached()
    {
        if ($this->stream === null) {
            throw new \LogicException('The stream is detached.');
        }
    }
}
