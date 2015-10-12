<?php

namespace BinSoul\Test\Bridge\Http\Message;

use BinSoul\Bridge\Http\Message\DefaultStreamFactory;
use Psr\Http\Message\StreamInterface;

class DefaultStreamFactoryTest extends \PHPUnit_Framework_TestCase
{
    /** @var string */
    protected $tempFile;

    public function tearDown()
    {
        if (file_exists($this->tempFile)) {
            @unlink($this->tempFile);
        }

        $this->tempFile = null;
    }

    public function test_creates_stream_interfaces()
    {
        $this->tempFile = tempnam(sys_get_temp_dir(), 'BinSoul');

        $factory = new DefaultStreamFactory();
        $stream = $factory->build($this->tempFile, 'r');

        $this->assertInstanceOf(StreamInterface::class, $stream);
        $this->assertFalse($stream->isWritable());
    }

    public function test_creates_specialized_streams()
    {
        $factory = new DefaultStreamFactory();
        $stream = $factory->build('php://memory', 'r');
        $this->assertEquals('php://memory', $stream->getMetadata('uri'));

        $stream = $factory->build('php://temp', 'r');
        $this->assertEquals('php://temp', $stream->getMetadata('uri'));

        $stream = $factory->build('php://input', 'r');
        $this->assertEquals('php://input', $stream->getMetadata('uri'));
    }
}
