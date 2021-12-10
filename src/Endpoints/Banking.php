<?php

namespace Zoop\Endpoints;

use Zoop\Routes;
use Zoop\Endpoints\Endpoint;

class Banking extends Endpoint
{

    /**
     * @param array $payload
     *
     * @return \ArrayObject
     */
    public function createKeyPix(array $payload)
    {
        return $this->client->request(
            self::POST,
            Routes::banking()->createKeyPix(
                $this->client->getMarketplaceId(),
                $this->client->getHolder(),
                $this->client->getAccountId()
            ),
            ['json' => $payload],
            [
                'Content-Type' => 'application/json',
            ]
        );
    }
}

