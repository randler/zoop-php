<?php

namespace Zoop\Exceptions;

final class ZoopException extends \Exception
{
    /**
     * @var int
     */
    protected $status;
    
    /**
     * @var string
     */
    protected $status_code;

    /**
     * @var string
     */
    protected $type;
    
    /**
     * @var string
     */
    protected $category;
    
    /**
     * @var string
     */
    protected $message;

    /**
     * @param boolean $status_code
     * @param int $description
     */
    public function __construct($body)
    {
        $body = json_decode($body, true);
        $error = $body['error'];
        $this->status = $error['status'];
        $this->status_code = $error['status_code'];
        $this->type = $error['type'];
        $this->category = $error['category'];
        $this->message = $error['message'];

        $exceptionMessage = $this->buildExceptionMessage();

        parent::__construct($exceptionMessage);
    }

    /**
     * @return string
     */
    private function buildExceptionMessage()
    {
        $exceptionMessage = sprintf(
            '%s (%s): %s',
            $this->status,
            $this->status_code,
            $this->message
        );

        return $exceptionMessage;

    }

    /**
     * @return boolean
     */
    public function getTag()
    {
        return $this->tag;
    }

    /**
     * @return string
     */
    public function getStatusCode()
    {
        return $this->status_code;
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Get the value of type
     *
     * @return  string
     */ 
    public function getType()
    {
        return $this->type;
    }

    /**
     * Get the value of category
     *
     * @return  string
     */ 
    public function getcategory()
    {
        return $this->category;
    }

    /**
     * Get the value of message
     *
     * @return  string
     */ 
    public function getMessageResponse()
    {
        return $this->message;
    }
}
