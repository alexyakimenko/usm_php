<?php

namespace App\Core\Http;

/**
 * Class Request
 *
 * Represents an HTTP request.
 */
class Request
{
    /**
     * @var array The request body.
     */
    public array $body = [];

    /**
     * @var string The HTTP method.
     */
    public string $method = 'GET';

    /**
     * @var array The request parameters.
     */
    public array $params = [];

    /**
     * Request constructor.
     *
     * @param array $body The request body.
     * @param array $params The request parameters.
     * @param string $method The HTTP method.
     */
    public function __construct(array $body = [], array $params = [], string $method = 'GET') {
        $this->body = $body;
        $this->method = $method;
        $this->params = $params;
    }
}