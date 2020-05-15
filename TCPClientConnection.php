<?php namespace ZN\Socket;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

use ZN\Socket\Exception\SocketConnectException;

class TCPClientConnection extends SocketExtends implements ConnectionInterface
{
    /**
     * Constructor.
     */
    public function __construct($host, $port, $domain, $config)
    {
        $this->extractConfig($config);

        $socket = $this->createSocketResource('tcp', SOCK_STREAM, $domain);

        if( ! socket_connect($socket, $host, $port) )
        {
            throw new SocketConnectException(NULL, $this->getLastError());
        }

        $this->socket = $socket;
    }

    /**
     * Read
     * 
     * @param int $length = 1024
     * @param int $type   = PHP_BINARY_READ - options[PHP_BINARY_READ|PHP_NORMAL_READ]
     */
    public function read(Int $length = 1024, Int $type = PHP_BINARY_READ)
    {
        return socket_read($this->socket, $length, $type);
    }

    /**
     * Write
     * 
     * @param string $content
     */
    public function write(String $content)
    {
        return socket_write($this->socket, $content, strlen($content));
    }

    /**
     * Close socket
     */
    public function close()
    {
        socket_close($this->socket);
    }
}