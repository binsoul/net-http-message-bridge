<?php

namespace BinSoul\Test\Bridge\Http\Message;

use BinSoul\IO\Stream\Stream as IoStream;
use BinSoul\IO\Stream\Type\MemoryStream;
use BinSoul\IO\Stream\Type\ResourceStream;
use Psr\Http\Message\StreamInterface;

abstract class AbstractStreamTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @param IoStream $stream
     * @param string   $accessMode
     *
     * @return mixed
     */
    abstract protected function createStream(IoStream $stream, $accessMode);

    public function test_creates_correct_access_mode()
    {
        $stream = $this->createStream(new MemoryStream(), 'r');

        $this->assertTrue($stream->isReadable());
        $this->assertFalse($stream->isWritable());
        $this->assertTrue($stream->isSeekable());
    }

    public function test_is_readable_and_writable()
    {
        $stream = $this->createStream(new MemoryStream(), 'r+');
        $stream->write('foo');

        $this->assertEquals(3, $stream->tell());
        $stream->seek(0);

        $this->assertEquals('foo', $stream->read(3));

        $stream->write('bar');
        $stream->seek(0);
        $this->assertEquals('foobar', $stream->read(6));
        $this->assertEquals(6, $stream->getSize());
    }

    /**
     * @expectedException \RuntimeException
     */
    public function test_read_raises_exception_on_error()
    {
        $mock = $this->getMock(IoStream::class);
        $mock->expects($this->once())->method('read')->willReturn(false);
        /* @var IoStream $mock */
        $stream = $this->createStream($mock, 'r+');

        $stream->read(3);
    }

    /**
     * @expectedException \RuntimeException
     */
    public function test_write_raises_exception_on_error()
    {
        $mock = $this->getMock(IoStream::class);
        $mock->expects($this->once())->method('write')->willReturn(false);
        /* @var IoStream $mock */
        $stream = $this->createStream($mock, 'r+');

        $stream->write('foo');
    }

    /**
     * @expectedException \RuntimeException
     */
    public function test_seek_raises_exception_on_error()
    {
        $mock = $this->getMock(IoStream::class);
        $mock->expects($this->once())->method('seek')->willReturn(false);
        /* @var IoStream $mock */
        $stream = $this->createStream($mock, 'r+');

        $stream->seek(0);
    }

    /**
     * @expectedException \RuntimeException
     */
    public function test_tell_raises_exception_on_error()
    {
        $mock = $this->getMock(IoStream::class);
        $mock->expects($this->once())->method('tell')->willReturn(false);
        /* @var IoStream $mock */
        $stream = $this->createStream($mock, 'r+');

        $stream->tell();
    }

    public function test_close_calls_close_on_stream()
    {
        $mock = $this->getMock(IoStream::class);
        $mock->expects($this->once())->method('close');
        /* @var IoStream $mock */
        $stream = $this->createStream($mock, 'r+');

        $stream->close();
    }

    public function test_getMetadata_returns_stream_metadata()
    {
        $mock = $this->getMock(IoStream::class);
        $mock->expects($this->once())->method('getMetadata')->willReturnArgument(0);
        /* @var IoStream $mock */
        $stream = $this->createStream($mock, 'r+');

        $this->assertEquals('key', $stream->getMetadata('key'));
    }

    public function test_toString_returns_entire_content()
    {
        $stream = $this->createStream(new MemoryStream(), 'r+');
        $stream->write('foo');

        $this->assertEquals(3, $stream->tell());
        $this->assertEquals('foo', $stream->__toString());
    }

    public function test_toString_catches_exceptions()
    {
        $mock = $this->getMock(IoStream::class);
        $mock->expects($this->any())->method('read')->willThrowException(new \RuntimeException());
        /* @var IoStream $mock */
        $stream = $this->createStream($mock, 'r+');

        $this->assertEquals('', $stream->__toString());
    }

    public function test_getContents_returns_remaining_content()
    {
        $stream = $this->createStream(new MemoryStream(), 'r+');
        $stream->write('foobar');
        $stream->seek(3);

        $this->assertEquals('bar', $stream->getContents());
    }

    public function test_can_provide_a_resource_or_null()
    {
        $stream = $this->createStream(new ResourceStream('php://memory'), 'r');
        $this->assertInternalType('resource', $stream->detach());

        $stream = $this->createStream(new MemoryStream(), 'r');
        $this->assertNull($stream->detach());
    }

    public function streamInterfaceMethods()
    {
        $result = [];
        foreach (get_class_methods(StreamInterface::class) as $method) {
            if ($method == '__toString') {
                continue;
            }

            $result[] = [$method];
        }

        return $result;
    }

    /**
     * @dataProvider streamInterfaceMethods
     * @expectedException \LogicException
     */
    public function test_detach_makes_stream_unusable($method)
    {
        $stream = $this->createStream(new MemoryStream(), 'r+');
        $stream->detach();

        $stream->{$method}(1);
    }
}
