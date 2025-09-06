<?php

namespace Omnipay\PowerTranz\Tests;

use Omnipay\Common\Http\ClientInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;

/**
 * A simple mock HTTP client for testing
 */
class MockHttpClient implements ClientInterface
{
    private ResponseInterface $response;

    public function __construct(ResponseInterface $response)
    {
        $this->response = $response;
    }

    /**
     * @param string $method
     * @param \Psr\Http\Message\UriInterface|string $url
     * @param array $headers
     * @param null $body
     * @param string $protocolVersion
     * @inheritDoc
     */
    public function request($method, $url, array $headers = [], $body = null, $protocolVersion = '1.1')
    {
        return $this->response;
    }
}

/**
 * A simple mock Response for testing
 */
class MockResponse implements ResponseInterface
{
    private int $statusCode;
    private array $headers;
    private StreamInterface $body;

    public function __construct(int $statusCode, array $headers, StreamInterface $body)
    {
        $this->statusCode = $statusCode;
        $this->headers = $headers;
        $this->body = $body;
    }

    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    public function withStatus($code, $reasonPhrase = ''): ResponseInterface
    {
        $new = clone $this;
        $new->statusCode = $code;
        return $new;
    }

    public function getReasonPhrase(): string
    {
        return 'OK';
    }

    public function getProtocolVersion(): string
    {
        return '1.1';
    }

    public function withProtocolVersion($version): \Psr\Http\Message\MessageInterface
    {
        return $this;
    }

    public function getHeaders(): array
    {
        return $this->headers;
    }

    public function hasHeader($name): bool
    {
        return isset($this->headers[$name]);
    }

    public function getHeader($name): array
    {
        return $this->hasHeader($name) ? [$this->headers[$name]] : [];
    }

    public function getHeaderLine($name): string
    {
        return $this->hasHeader($name) ? $this->headers[$name] : '';
    }

    public function withHeader($name, $value): \Psr\Http\Message\MessageInterface
    {
        $new = clone $this;
        $new->headers[$name] = $value;
        return $new;
    }

    public function withAddedHeader($name, $value): \Psr\Http\Message\MessageInterface
    {
        return $this->withHeader($name, $value);
    }

    public function withoutHeader($name): \Psr\Http\Message\MessageInterface
    {
        $new = clone $this;
        unset($new->headers[$name]);
        return $new;
    }

    public function getBody(): StreamInterface
    {
        return $this->body;
    }

    public function withBody($body): \Psr\Http\Message\MessageInterface
    {
        $new = clone $this;
        $new->body = $body;
        return $new;
    }
}

/**
 * A simple mock Stream for testing
 */
class MockStream implements StreamInterface
{
    private string $content;

    public function __construct(string $content)
    {
        $this->content = $content;
    }

    public function __toString(): string
    {
        return $this->content;
    }

    public function close(): void
    {
    }

    public function detach()
    {
        return null;
    }

    public function getSize(): ?int
    {
        return strlen($this->content);
    }

    public function tell(): int
    {
        return 0;
    }

    public function eof(): bool
    {
        return true;
    }

    public function isSeekable(): bool
    {
        return false;
    }

    public function seek($offset, $whence = SEEK_SET): void
    {
    }

    public function rewind(): void
    {
    }

    public function isWritable(): bool
    {
        return false;
    }

    public function write($string): int
    {
        return 0;
    }

    public function isReadable(): bool
    {
        return true;
    }

    public function read($length): string
    {
        return '';
    }

    public function getContents(): string
    {
        return $this->content;
    }

    public function getMetadata($key = null)
    {
        return null;
    }
}