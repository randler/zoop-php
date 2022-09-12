<?php

namespace Zoop;

use GuzzleHttp\Exception\ClientException;
use Zoop\Exceptions\ZoopException;
use Zoop\Exceptions\InvalidJsonException;

class ResponseHandler
{
    /**
     * @param string $payload
     *
     * @throws \Zoop\Exceptions\InvalidJsonException
     * @return \ArrayObject
     */
    public static function success($payload)
    {
        return self::toJson($payload);
    }

    /**
     * @param ClientException $originalException
     *
     * @throws ZoopException
     * @return object
     */
    public static function failure(\Exception $originalException)
    {
        return (object) self::parseException($originalException);
    }

    /**
     * @param ClientException $guzzleException
     *
     * @return ZoopException|ClientException
     */
    private static function parseException(ClientException $guzzleException)
    {
        $response = $guzzleException->getResponse();
        
        if (is_null($response)) {
            return $guzzleException;
        }
        
        $body = $response->getBody()->getContents();

        //fwrite(STDERR, print_r($body));

        try {
            return self::toJson($body);
        } catch (InvalidJsonException $invalidJson) {
            return $guzzleException;
        }

        //fwrite(STDERR, print_r($marketplace));
                
        return new ZoopException($body);
    }

    /**
     * @param string $json
     * @return \ArrayObject
     */
    private static function toJson($json)
    {

        while (gettype($json) == 'string') {
            $json = json_decode($json, true);
        }

        $result = $json;

        if (json_last_error() != \JSON_ERROR_NONE) {
            throw new InvalidJsonException(json_last_error_msg());
        }

        return $result;
    }
}
