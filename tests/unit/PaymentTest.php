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
use Zoop\Beans\Webhook;

class ClientTest extends TestCase
{
    public function testRequestAuth()
    {
        $zpk = 'zpk_test........Td0';
        $marketplaceId = '43.......92b';
        $SellerId = '1a4.......499';

        $client = new Client(
          $marketplaceId, 
          $SellerId, 
          $zpk
        );
        
        // Requisição de token funcionando
       

        /*$payment = new Transaction();
        $payment->setDescription('Teste de transação')
                ->setAmount(1035)
                ->setOnBehalfOf($SellerId); // responsavel pela venda

        $pixData = $payment->getPaymentPix();

        //fwrite(STDERR, print_r($pixData, true));
        
        $pix = $client
            ->payment()
            ->pix($pixData);*/

        $webhook = new Webhook();
        $webhook->setUrl("http://fomefome.loc/api/v3/order/webhook-zoop.html"); // responsavel pela venda
        $webhook->setMethod(Webhook::POST);

        $webhookData = $webhook->getWebhookData();

        //fwrite(STDERR, print_r($pixData, true));
        
        $webhook = $client
            ->webhook()
            ->create($webhookData);

      /*$pix = $client
        ->banking()
        ->createKeyPix([
          "type" => "email",
          "value" => "randlersi@gmail.com"
        ]);*/

        fwrite(STDERR, print_r($webhook, true));
        
    }
}


// é preciso criar a forma de gerar a chave de acesso
// ver nessa documentação DICT: https://docs.zoop.com.br/banking-api/referencia-api/pix-1/pix
// ver documentação geral: https://docs.zoop.co/reference#introducao
