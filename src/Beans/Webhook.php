<?php

namespace Zoop\Beans;

use Zoop\Client;

class Webhook
{

    const POST = 'POST';
    const GET = 'GET';
    const PUT = 'PUT';
    const DELETE = 'DELETE';
    
    /**
    * @var array | 
    */
    private $event = ['all'];
    
    /**
    * @var array | 
    */
    private $event_custom = [];


    /**
    * @var string
    */
    private $url;
    
    /**
    * @var string
    */
    private $method = 'POST';
    
    /**
    * @var string
    */
    private $description = 'Weebhook Pix';

    /**
    * @var string | BRL
    */
    private $authorization = 'top-secret';

    public function __construct() {}

    /**
     * Get the value of recurrent
     *
     * @return  array
     */ 
    public function getWebhookData()
    {
        $events = $this->event;
        if(!empty($this->event_custom)) {
            $events = $this->event_custom;
        }

        return [
            "event" => $events,
            "url" => $this->url,
            "description" => $this->description,
            "authorization" => $this->authorization,
            "method" => $this->method
        ];
    }

    /**
     * Get |
     *
     * @return  array
     */ 
    public function getEvent()
    {
        return $this->event;
    }

	/**
	 * Set |
	 *
	 * @param   array  $event  |
	 * 
	 * return $this
	 *
	 */
	public function setEvent(array $event)
	{
		$this->event = $event;
		return $this;
	}

    /**
     * Get |
     *
     * @return  array
     */
    public function addEvent(string $event) 
    {
        $this->event_custom[] = $event;
        return $this;
    }

    /**
     * Get |
     *
     * @return  array
     */
    public function getEvents()
    {
        return $this->event_custom;
    }

    /**
     * Get the value of url
     *
     * @return  string
     */ 
    public function getUrl()
    {
        return $this->url;
    }

	/**
	 * Set the value of url
	 *
	 * @param   string  $url  
	 * 
	 * return $this
	 *
	 */
	public function setUrl(string $url)
	{
		$this->url = $url;
		return $this;
	}

    /**
     * Get the value of description
     *
     * @return  string
     */ 
    public function getDescription()
    {
        return $this->description;
    }

	/**
	 * Set the value of description
	 *
	 * @param   string  $description  
	 * 
	 * return $this
	 *
	 */
	public function setDescription(string $description)
	{
		$this->description = $description;
		return $this;
	}

    /**
     * Get | BRL
     *
     * @return  string
     */ 
    public function getAuthorization()
    {
        return $this->authorization;
    }

	/**
	 * Set | BRL
	 *
	 * @param   string  $authorization  | BRL
	 * 
	 * return $this
	 *
	 */
	public function setAuthorization(string $authorization)
	{
		$this->authorization = $authorization;
		return $this;
	}

    /**
     * Set the value of method
     */
    public function setMethod($method)
    {
        $this->method = $method;

        return $this;
    }
}

