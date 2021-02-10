<?php

namespace TitanII\Test;

require_once(__DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php');

use TitanII\Server;
use TitanII\Request;
use TitanII\Response;

$server = new Server();

$server->start(function (Request $request): Response {
    return new Response();
});