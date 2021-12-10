<?php

namespace Zoop;

use Zoop\Anonymous;

class Routes
{
    /**
     * @return \Zoop\Anonymous
     */
    public static function payment()
    {
        $anonymous = new Anonymous();

        $anonymous->pix = static function ($marketplaceId) {
            return "marketplaces/$marketplaceId/transactions";
        };

        return $anonymous;
    }


    /**
     * @return \Zoop\Anonymous
     */
    public static function banking()
    {
        $anonymous = new Anonymous();

        $anonymous->createKeyPix = static function ($marketplaceId, $holderId, $accountId) {
            return "marketplaces/$marketplaceId/banking/dict/holders/$holderId/accounts/$accountId/entries";
        };

        return $anonymous;
    }
}
