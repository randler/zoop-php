<?php
namespace Zoop\Test;

require_once ('vendor/autoload.php');

/** Testes
 * ./vendor/bin/phpunit --bootstrap vendor/autoload.php tests/unit/PaymentTest.php
 */

use Zoop\Beans\CustomerCard;
use Zoop\Beans\Items;
use Zoop\Beans\PaymentData;
use Zoop\Beans\SellerInfo;
use Zoop\Beans\Sellers;
use Zoop\Client;
use Zoop\Key;
use PHPUnit\Framework\TestCase;
use Zoop\Beans\Transaction;

class ClientTest extends TestCase
{
    public function testRequestAuth()
    {
        $zpk = 'zpk_test_...joTd0';
        $marketplaceId = '438...b92b';
        $SellerId = '1a41...499';

        $client = new Client(
          $marketplaceId, 
          $SellerId, 
          $zpk
        );
        
        // Requisição de token funcionando
       

        $payment = new Transaction();
        $payment->setDescription('Teste de transação')
                ->setAmount(1035)
                ->setOnBehalfOf($SellerId); // responsavel pela venda

        $pixData = $payment->getPaymentPix();

        //fwrite(STDERR, print_r($pixData, true));
        
        $pix = $client
            ->payment()
            ->pix($pixData);

      /*$pix = $client
        ->banking()
        ->createKeyPix([
          "type" => "email",
          "value" => "randlersi@gmail.com"
        ]);*/

        fwrite(STDERR, print_r($pix, true));

        //$response = $client->ride()->details(["id" => 162,"institution_id" => 1, "token" => '$2y$10$u8aWfSLtr3HwFUwrZXSZh.c5cda.rntSyUwEAbW2OEvGTDUGoaIn6']);
        //fwrite(STDERR, print_r($client->getScope()));
        
    }
}


// é preciso criar a forma de gerar a chave de acesso
// ver nessa documentação DICT: https://docs.zoop.com.br/banking-api/referencia-api/pix-1/pix
// ver documentação geral: https://docs.zoop.co/reference#introducao
