<?php namespace ZN\Socket\UDP;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

use ZN\Socket\SocketExtends;
use ZN\Socket\StructureInterface;
use ZN\Socket\Exception\SocketConnectException;

class Client extends SocketExtends implements StructureInterface
{
    /**
     * Constructor.
     */
    public function __construct($host, $port, $domain, $config)
    {
        $this->extractConfig($config);

        $socket = $this->createSocketResource('udp', SOCK_DGRAM, $domain);

        if( ! socket_connect($socket, $host, $port) )
        {
            throw new SocketConnectException(NULL, $this->getLastError());
        }

        $this->socket = $socket; $this->host = $host; $this->port = $port;
    }

    /**
     * Read
     * 
     * @param int $length = 1024
     * @param int $type   = 0 - options[MSG_OOB|MSG_PEEK|MSG_WAITALL|MSG_DONTWAIT]
     */
    public function read(Int $length = 1024, Int $type = 0)
    {
        socket_recvfrom($this->socket, $content, $length, $type, $name, $port);

        return $content;
    }

    /**
     * Write
     * 
     * @param string $content
     * @param int $type   = 0 - options[MSG_OOB|MSG_EOR|MSG_EOF|MSG_DONTROUTE]
     */
    public function write(String $content, Int $type = 0)
    {
        return socket_sendto($this->socket, $content, strlen($content), $type, $this->host, $this->port);
    }

    /**
     * Close socket
     */
    public function close()
    {
        socket_close($this->socket);
    }
}