<?php

namespace Zoop\Endpoints;

use Zoop\Routes;
use Zoop\Endpoints\Endpoint;

class Webhook extends Endpoint
{

    /**
     * @param array $payload
     *
     * @return \ArrayObject
     */
    public function list()
    {
        return $this->client->request(
            self::GET,
            Routes::webhook()->list($this->client->getMarketplaceId()),
            [],
            [
                'Content-Type' => 'application/json',
            ]
        );
    }

    /**
     * @param array $payload
     *
     * @return \ArrayObject
     */
    public function events()
    {
        return $this->client->request(
            self::GET,
            Routes::webhook()->events($this->client->getMarketplaceId()),
            [],
            [
                'Content-Type' => 'application/json',
            ]
        );
    }

    /**
     * @param array $payload
     *
     * @return \ArrayObject
     */
    public function create(array $payload)
    {
        return $this->client->request(
            self::POST,
            Routes::webhook()->create($this->client->getMarketplaceId()),
            ['json' => $payload],
            [
                'Content-Type' => 'application/json',
            ]
        );
    }

    /**
     * @param array $payload
     *
     * @return \ArrayObject
     */
    public function delete(array $payload)
    {
        return $this->client->request(
            self::DELETE,
            Routes::webhook()->delete($this->client->getMarketplaceId(), $payload['webhook_id']),
            [],
            [
                'Content-Type' => 'application/json',
            ]
        );
    }

}

