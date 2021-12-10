<?php

namespace Zoop\Endpoints;

use Zoop\Client;

abstract class Endpoint
{
    /**
     * @var string
     */
    const POST = 'POST';
    /**
     * @var string
     */
    const GET = 'GET';
    /**
     * @var string
     */
    const PUT = 'PUT';
    /**
     * @var string
     */
    const DELETE = 'DELETE';

    /**
     * @var \Zoop\Client
     */
    protected $client;

    /**
     * @param \Zoop\Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }
}
