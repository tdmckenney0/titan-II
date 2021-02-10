<?php 

namespace TitanII;

use TitanII\Request;
use TitanII\Response;

/**
 * Gemini Server
 * 
 * @author Tanner Mckenney <tmckenney7@outlook.com>
 */
class Server {
    public function start(callable $action): void
    {
        $request = new Request();

        $response = $action($request);
    }
}
