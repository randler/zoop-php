<?php

namespace Zoop\Endpoints;

use Zoop\Routes;
use Zoop\Endpoints\Endpoint;

class Payment extends Endpoint
{

    /**
     * @param array $payload
     *
     * @return \ArrayObject
     */
    public function pix(array $payload)
    {
        return $this->client->request(
            self::POST,
            Routes::payment()->pix($this->client->getMarketplaceId()),
            ['json' => $payload],
            [
                'Content-Type' => 'application/json',
            ]
        );
    }
}

