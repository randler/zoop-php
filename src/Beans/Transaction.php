<?php

namespace Zoop\Beans;

use Zoop\Client;

class Transaction
{

    /**
    * @var string | 
    */
    private $on_behalf_of;

    /**
    * @var string
    */
    private $description;
    
    /**
    * @var int
    */
    private $amount;

    /**
    * @var string | BRL
    */
    private $currency = 'BRL';

    /**
    * @var string | 
    */
    private $payment_type;

    public function __construct() {}

    /**
     * Get the value of transactionType
     *
     * @return  string
     */ 
    public function getPaymentType()
    {
        return $this->payment_type;
    }

    /**
     * Set the value of transactionType
     *
     * @param  string  $transactionType | credit, debit
     *
     */ 
    public function setPaymentType(string $payment_type)
    {
        $this->$payment_type = $payment_type;
        return $this;
    }

    /**
     * Get the value of transactionType
     *
     * @return  string
     */ 
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set the value of transactionType
     *
     * @param  string  $transactionType | credit, debit
     *
     */ 
    public function setDescription(string $description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * Get the value of amount
     *
     * @return  int
     */ 
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * Set the value of amount
     *
     * @param  int  $amount
     *
     */ 
    public function setAmount(int $amount)
    {
        $this->amount = $amount;
        return $this;
    }
    /**
     * Get the value of on_behalf_of
     *
     * @return  int
     */ 
    public function getOnBehalfOf()
    {
        return $this->on_behalf_of;
    }

    /**
     * Set the value of on_behalf_of
     *
     * @param  int  $on_behalf_of
     *
     */ 
    public function setOnBehalfOf(string $on_behalf_of)
    {
        $this->on_behalf_of = $on_behalf_of;
        return $this;
    }

    /**
     * Get the value of currency
     *
     * @return  string
     */ 
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * Set the value of currency
     *
     * @param  string  $currency | brl
     *
     */ 
    public function setCurrency(string $currency)
    {
        $this->currency = $currency;
        return $this;
    }

    /**
     * Get the value of recurrent
     *
     * @return  array
     */ 
    public function getPaymentPix()
    {
        return [
            "on_behalf_of" => $this->on_behalf_of,
            "description" => $this->description,
            "currency" => $this->currency,
            "amount" => $this->amount,
            "payment_type" => 'pix'
        ];
    }


}

