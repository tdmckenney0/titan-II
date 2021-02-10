<?php

namespace TitanII\Test;

require_once(__DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php');

use TitanII\Server;
use TitanII\Request;
use TitanII\Response;

// Make a new server
$server = new Server();

// Set the certs. 
$server->setCert(__DIR__ . DIRECTORY_SEPARATOR . 'certs' . DIRECTORY_SEPARATOR . 'cert.pem');
$server->setKey(__DIR__ . DIRECTORY_SEPARATOR . 'certs' . DIRECTORY_SEPARATOR . 'key.rsa');

// Response Body (Gemini Text!)
$body = <<<GEMINI
# Titan II Lifts off!

The tower is clear!
GEMINI;

/**
 * Set a request handler.
 * 
 * This function must take a `TitanII\Request` object, and return a `TitanII\Response` object. 
 */
$server->setHandler(function (Request $request) use (&$body): Response {
    $response = new Response();

    $response->setMeta('text/gemini');
    $response->setContent($body);

    echo $request;

    return $response;
});

/**
 * Boot the server!
 */
$server->start();
