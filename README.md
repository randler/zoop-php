<p align="center">
  <a href="https://github.com/randler/Zoop-php">
    <img alt="Zoop" src="https://zoop.com.br/wp-content/themes/zoop/img/novo/logo_zoop.svg" width="200">
  </a>
</p>

<h1 align="center">
  <a href="https://github.com/randler/Zoop-php">
    Gateway Zoop PHP
  </a>
</h1>
<p align="center">
  Biblioteca desenvolvida para facilitar a comunicação com o gateway de pagamento Zoop.
</p>

<p align="center">
  <a href="https://github.com/facebook/react-native/blob/master/LICENSE">
    <img src="https://img.shields.io/badge/license-MIT-blue.svg" alt="React Native is released under the MIT license." />
  </a>
  <a href="https://github.com/codificar/delivery-api-php/releases/">
    <img src="https://img.shields.io/badge/vers%C3%A3o-2.0.4-green" alt="Versão" />
  </a>
  <a href="https://packagist.org/packages/randler/lib-zoop-php">
    <img src="https://img.shields.io/packagist/dt/randler/lib-zoop-php.svg" alt="Downloads" />
  </a>
</p>

# Introdução

Essa SDK foi construída com o intuito de tornar flexível as chamadas dos metodos de pagamento, de forma que todos possam utilizar todas as features, de todas as versões de API.

Você pode acessar a documentação oficial da API acessando esse [link](https://developers.Zoop.io/manual/ecommerce#vis%C3%A3o-geral-Zoop-e-commerce).


## Índice

- [Instalação](#instalação)
- [Configuração](#configuração)
- [Requisições](#requisições)
  - [Requisição de Transação](#requisição-de-transação)
    - [Criar Transação Pix](#criar-transação-pix)
  - [Requisição de Webhook](#requisição-de-webhook)
    - [Listar Webhook](#listar-webhook)
    - [Criar Webhook](#criar-webhook)
    - [Remover Webhook](#remover-webhook)
<br>
<br>
<br>
<br>


## Instalação

Instale a biblioteca utilizando o comando

`composer require randler/lib-zoop-php`
<br>
<br>
<hr>

## Configuração

Para incluir a biblioteca em seu projeto, basta fazer o seguinte:

```php
<?php
  require('vendor/autoload.php');
  
  $zpk = 'zpk_test........Td0';
  $marketplaceId = '43.......92b';
  $SellerId = '1a4.......499';

  $Zoop = new Zoop\Client(
    $marketplaceId, 
    $SellerId, 
    $zpk
  );
```
<br>
<br>
<hr>

## Requisições

Nesta seção será explicado como realizar requisições autorização no Zoop.
<br>

### Requisição de Transação

Nesta seção será explicado como realizar requisições de transação no Zoop.
#### Criar Transação Pix

Para criar uma transação Pix:

```php
<?php

  $payment = new Transaction();
  $payment->setDescription('Teste de transação')
          ->setAmount(1035)
          ->setOnBehalfOf($SellerId); // responsavel pela venda

  $pixData = $payment->getPaymentPix();
  
  $pix = $client
      ->payment()
      ->pix($pixData);
```
<br>
<br>
<hr>

### Requisição de Webhook

Nesta seção será explicado como realizar requisições de transação no Zoop.


#### Listar Webhook

Para listar os webhooks:

```php
<?php

  $webhook = $client
      ->webhook()
      ->list();
```
<br>
<br>
<hr>

#### Criar Webhook

Para criar um webhook:

```php
<?php

  $webhook = new Webhook();
  $webhook->setUrl("http://fomefome.loc/api/v3/order/webhook-zoop.html"); // responsavel pela venda

  $webhookData = $webhook->getWebhookData();
        
  $webhook = $client
      ->webhook()
      ->create($webhookData);
```
<br>
<br>
<hr>
<br>

#### Remover Webhook

Para remover um webhook especifico:

```php
<?php
      
  $webhook = $client
      ->webhook()
      ->delete(['webhook_id' => '475476f22...97bb8ea8']);
```
<br>
<br>
<hr>
<br>
