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
    /**
     * Context created by stream_context_create();
     * 
     * @var resource 
     */
    private $context = null;

    /**
     * Socket created by stream_socket_server();
     * 
     * @var resource 
     */
    private $socket = null;

    /**
     * Function that gets called to handle incoming requests.
     * 
     * @var callable
     */
    private $handler = null;

    /**
     * Server active flag. 
     * 
     * @var bool
     */
    private bool $active = false;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->context = stream_context_create();

        stream_context_set_option($this->context, 'ssl', 'allow_self_signed', true);
        stream_context_set_option($this->context, 'ssl', 'verify_peer', false);
    }

    /**
     * @param callable Handle incoming requests. 
     * 
     * @return self Method chaining. 
     * 
     * Parameter 1 Callable is expected to handle the following:
     * 
     * @param Request
     * 
     * @return Response
     */
    public function setHandler(callable $handler): self
    {
        $this->handler = $handler;

        return $this;
    }

    /**
     * Set the Certification file. 
     * 
     * @return self Method chaining. 
     */
    public function setCert(string $file): self
    {
        stream_context_set_option($this->context, 'ssl', 'local_cert', $file);

        return $this;
    }

    /**
     * Optional. Set cert paassphrase. 
     * 
     * @param string
     * 
     * @return self Method chaining. 
     */
    public function setCertPassphrase(string $passphrase): self
    {
        stream_context_set_option($this->context, 'ssl', 'passphrase', $passphrase);

        return $this;
    }

    /**
     * Set the Key file.
     * 
     * @param string
     * 
     * @return self Method chaining. 
     */
    public function setKey(string $key): self
    {
        stream_context_set_option($this->context, 'ssl', 'local_pk', $key);

        return $this;
    }

    /**
     * Open the server socket. 
     * 
     * @param string IP Address
     * @param int Port Number. 
     * 
     * @return bool True on success, false on failure. 
     */
    protected function openSocket(string $ip, int $port): bool
    {
        $addr = "tcp://" . $ip . ':' . $port;

        $this->socket = stream_socket_server($addr, $errno, $errstr, STREAM_SERVER_BIND | STREAM_SERVER_LISTEN, $this->context);

        if (empty($this->socket)) {
            return false;
        }

        stream_socket_enable_crypto($this->socket, false);

        return true;
    }

    /**
     * Start the server!
     * 
     * @param string IP Address
     * @param int Port Number.
     */
    public function start(string $ip = '0', int $port = 1965): void
    {
        $this->openSocket($ip, $port);
        
        $this->active = true; 

        while ($this->active) {
            $incoming = stream_socket_accept($this->socket, -1, $peername);

            stream_set_blocking($incoming, true);
            stream_socket_enable_crypto($incoming, true, STREAM_CRYPTO_METHOD_TLSv1_2_SERVER);

            $body = fread($incoming, 1024);

            stream_set_blocking($incoming, false);

            $request = new Request($body);

            $response = call_user_func($this->handler, $request);

            fwrite($incoming, $response);

            fclose($incoming);
        }
    }

    /**
     * Stop the server!
     */
    public function stop(): void
    {
        $this->active = false;
    }
}
