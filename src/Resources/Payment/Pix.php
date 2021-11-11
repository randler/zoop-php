<?php 
namespace Zoop\Payment;

use Zoop\Zoop;

class Pix extends Zoop 
{
    public function __construct($configurations)
    {
        parent::__construct($configurations);
    }

    public function preparePix(array $pix, $referenceId = null)
    {
        $payment = array(

            'amount' => $pix['amount'],
            'description' => $pix['description'],
            'creditor' => array(

                'national_registration' => $pix['creditor']['cpf_cnpj'],

                //Código da instituição participante do Pix onde a conta do recebedor está criada
                'psp' => $pix['creditor']['psp'],

                'key' => array(

                    'value' => $pix['creditor']['key']['value'],
                    'type' => $pix['creditor']['key']['type']
                )
                    
            )
        );
        if(!is_null($referenceId)){
            $payment['reference_id'] = $referenceId;
        }
        return $payment;
        
    }

    public function payPix(array $pix, $referenceId = null)
    {
        try {
            $payment = $this->preparePix($pix, $referenceId);
            $request = $this->configurations['guzzle']->request(
                'POST', '/v3/marketplaces/'. $this->configurations['marketplace']. 'banking/pix/holders/' . $this->configurations['holder'] . '/accounts/' . $this->configurations['account'] .'/payments',
                ['json' => $payment]
            );
            $response = \json_decode($request->getBody()->getContents(), true);
            if($response && is_array($response)){
                return $response;
            }
            return false;
        } catch (\Exception $e){            
            return $this->ResponseException($e);
        }
    }
}