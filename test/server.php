<?php

namespace TitanII\Test;

require_once(__DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php');

use TitanII\Server;
use TitanII\Request;
use TitanII\Response;

$server = new Server();

$server->setCert(__DIR__ . DIRECTORY_SEPARATOR . 'certs' . DIRECTORY_SEPARATOR . 'cert.pem');
$server->setKey(__DIR__ . DIRECTORY_SEPARATOR . 'certs' . DIRECTORY_SEPARATOR . 'key.rsa');

$body = <<<GEMINI
# This is a server test!

Congrats! You passed!
GEMINI;

$server->setHandler(function (Request $request) use (&$body): Response {
    $response = new Response();

    $response->setMeta('text/gemini');
    $response->setContent($body);

    echo $request;

    return $response;
});

$server->start();