<?php

declare (strict_types = 1);

namespace BinSoul\Bridge\Http\Message;

use BinSoul\IO\Stream\Type\PhpInputStream;
use BinSoul\IO\Stream\Type\PhpMemoryStream;
use BinSoul\IO\Stream\Type\PhpOutputStream;
use BinSoul\IO\Stream\Type\PhpTempStream;
use BinSoul\IO\Stream\Type\ResourceStream;
use Psr\Http\Message\StreamInterface;

/**
 * Builds instances of the Stream class.
 */
class DefaultStreamFactory implements StreamFactory
{
    public function build(string $uri, string $mode): StreamInterface
    {
        switch (strtolower($uri)) {
            case 'php://input':
                $stream = new PhpInputStream();

                break;
            case 'php://output':
                $stream = new PhpOutputStream();

                break;
            case 'php://memory':
                $stream = new PhpMemoryStream();

                break;
            case 'php://temp':
                $stream = new PhpTempStream();

                break;
            default:
                $stream = new ResourceStream($uri);
        }

        return new Stream($stream, $mode);
    }
}
