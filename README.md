# Titan II

Gemini Protocol library for PHP. 

 - [gemini://gemini.circumlunar.space/](gemini://gemini.circumlunar.space/)
 - [https://gemini.circumlunar.space/](https://gemini.circumlunar.space/)

## Basic Implentation

```
<?php

use TitanII\Request;
use TitanII\Response;
use TitanII\Server;

$server = new Server();

$server->setCert('cert.pem');
$server->setKey('key.rsa');

$server->setHandler(function (Request $request): Response {
    $response = new Response();

    $response->setCode(20);
    $response->setMeta("text/plain");
    $response->setContent("Hello World!");

    return $response;
});

$server->start();
```

## Instructions 

1. run `cd test/certs; openssl req -x509 -newkey rsa:4096 -keyout key.rsa -out cert.pem -days 3650 -nodes -subj "/CN=127.0.0.1"`
2. run `composer install`
3. run `cd ..; php server.php`
4. Open `gemini://127.0.0.1`