<?php

namespace TitanII\Test;

require_once(__DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php');

use TitanII\Server;
use TitanII\Request;
use TitanII\Response;

$server = new Server();

$server->setCert(__DIR__ . DIRECTORY_SEPARATOR . 'certs' . DIRECTORY_SEPARATOR . 'cert.pem');
$server->setKey(__DIR__ . DIRECTORY_SEPARATOR . 'certs' . DIRECTORY_SEPARATOR . 'key.rsa');

$server->setHandler(function (Request $request): Response {
    $response = new Response();

    $response->setMeta('text/plain');
    $response->setContent("Hello world!");

    echo $request;

    return $response;
});

$server->start();