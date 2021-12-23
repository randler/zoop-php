<?php

namespace Zoop;

use Zoop\Endpoints\Payment;
use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\Exception\ClientException as ClientException;
use Zoop\Endpoints\Banking;
use Zoop\Endpoints\Webhook;
use Zoop\Exceptions\InvalidJsonException;

class Client
{

    /**
     * @var string header used to identify application's requests
     */
    const DELIVERY_USER_AGENT_HEADER = 'X-Zoop-User-Agent';


    /**
     * @var \Zoop\Endpoints\Payment
     */
    private $payment;
   
    /**
     * @var \Zoop\Endpoints\Webhook
     */
    private $webhook;
    
    /**
     * @var \Zoop\Endpoints\Banking
     */
    private $banking;
    
   
    /**
     * @var string
     */
    private $marketplace_id;
    
    /**
     * @var string
     */
    private $seller_id;
    
    /**
     * @var string
     */
    private $zpk_key;
    
    /**
     * @var string
     */
    private $account_id;

    /**
     * @var string
     */
    const BASE_URI = "https://api.zoop.ws/v1/";

    /**
     * @param string $marketplace_id
     * @param string $seller_id
     * @param string $account_id
     * @param string $zpk_key
     * @param array|null $extras
     * @param boolean|false $sandbox
     */
    public function __construct(
        String $marketplace_id, 
        String $seller_id, 
        String $zpk_key,
        array $extras = null
    )
    {

        $base_url = self::BASE_URI;
        $this->marketplace_id = $marketplace_id;
        $this->seller_id = $seller_id;
        $this->zpk_key = $zpk_key;

        $options = ['base_uri' => $base_url];

        if (!is_null($extras)) {
            $options = array_merge($options, $extras);
        }

        $userAgent = isset($options['headers']['User-Agent']) ?
            $options['headers']['User-Agent'] :
            '';

        //$options['headers'] = $this->addUserAgentHeaders($userAgent);
        $options['headers'] = [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'Authorization' => 'Basic ' . base64_encode($this->zpk_key . ':'),
        ];
        $this->http = new HttpClient($options);

        $this->payment = new Payment($this);
        $this->webhook = new Webhook($this);
        $this->banking = new Banking($this);
    }


    /**
     * @param string $method
     * @param string $uri
     * @param array $options
     *
     * @throws \Adiq\Exceptions\AdiqException
     * @return \ArrayObject
     *
     * @psalm-suppress InvalidNullableReturnType
     */
    public function request($method, $uri, $options = [], $header = [])
    {
        try {

            $userAgent = isset($header['headers']['User-Agent']) ?
                $header['headers']['User-Agent'] :
                '';
            if(isset($header) && !empty($header)) {
               $base_url = self::BASE_URI;
        
                $options = array_merge($options, ['base_uri' => $base_url]);

                //$options['headers'] = $this->addUserAgentHeaders($userAgent);
                $options['headers'] = [
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json',
                    'Authorization' => 'Basic ' . base64_encode($this->zpk_key . ':')
                ];

                $this->http = new HttpClient($options);
            }
            
            $response = $this->http->request(
                $method,
                $uri,
                $options
            );

            $body = ResponseHandler::success((string)$response->getBody());
            if(isset($body->accessToken) && !empty($body->accessToken)) {
                $this->accessToken = $body->accessToken;
                $this->tokenType = $body->tokenType;
                $this->expiresIn = $body->expiresIn;
                $this->scope = $body->scope;
            }

            return $body;
        } catch (InvalidJsonException $exception) {
            throw $exception;
        } catch (ClientException $exception) {
            ResponseHandler::failure($exception);
        } catch (\Exception $exception) {
            throw $exception;
        }
    }

    /**
     * Build an user-agent string to be informed on requests
     *
     * @param string $customUserAgent
     *
     * @return string
     */
    private function buildUserAgent($customUserAgent = '')
    {
        return trim(sprintf(
            '%s PHP/%s',
            $customUserAgent,
            phpversion()
        ));
    }

    /**
     * Append new keys (the default and delivery) related to user-agent
     *
     * @param string $customUserAgent
     * @return array
     */
    private function addUserAgentHeaders($customUserAgent = '')
    {
        return [
            'User-Agent' => $this->buildUserAgent($customUserAgent),
            'Content-Type' => "application/json",
            self::DELIVERY_USER_AGENT_HEADER => $this->buildUserAgent(
                $customUserAgent
            )
        ];
    }

    /**
     * @return \Zoop\Endpoints\Payment
     */
    public function payment()
    {
        return $this->payment;
    }
    
    /**
     * @return \Zoop\Endpoints\Webhook
     */
    public function webhook()
    {
        return $this->webhook;
    }

    /**
     * @return \Zoop\Endpoints\Banking
     */
    public function banking()
    {
        return $this->banking;
    }

    
    /**
     * @return string
     */
    public function getHolder()
    {
        return $this->seller_id;
    }
    
    /**
     * @return string
     */
    public function getZpkKey()
    {
        return $this->zpk_key;
    }
    
    /**
     * @return string
     */
    public function getAccountId()
    {
        return $this->account_id;
    }
    
    /**
     * @return string
     */
    public function getMarketplaceId()
    {
        return $this->marketplace_id;
    }
}
