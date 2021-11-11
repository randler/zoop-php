<?php
namespace Zoop\Test;

use PHPUnit\Framework\TestCase;
use Zoop\Core\Config;
use Zoop\ZoopClient;

require_once ('vendor/autoload.php');

/** Testes
 * ./vendor/bin/phpunit --bootstrap vendor/autoload.php tests/unit/PaymentTest.php
 */


class ClientTest extends TestCase
{
    public function Pix()
    {
        $token = ''; /** Token gerado ADM Mkt Zoop */
        $marketplace = ''; /* ID do Marketplace **/
        $vendedor = ''; /** ID do vendedor do marketplace */
        $holder = ''; /** ID da holder **/
        $account = ''; /** ID da Conta **/
        $sandbox = true; /** true para ambiente de testes, false para ambiente de produção **/
        $client = new ZoopClient(
            Config::configure($token, $marketplace, $vendedor, null, $holder, $account, $sandbox)
        );
        
    }
}
