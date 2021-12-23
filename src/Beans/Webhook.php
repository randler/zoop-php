<?php

namespace Zoop\Beans;

use Zoop\Client;

class Webhook
{

    /**
    * @var array | 
    */
    private $event = ['all'];

    /**
    * @var string
    */
    private $url;
    
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
        return [
            "event" => $this->event,
            "url" => $this->url,
            "description" => $this->description,
            "authorization" => $this->authorization,
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
}

