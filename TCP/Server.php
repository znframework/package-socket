<?php namespace ZN\Socket\TCP;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

use ZN\Socket\ServerMethods;
use ZN\Socket\SocketExtends;
use ZN\Socket\StructureInterface;
use ZN\Socket\Exception\SocketBindException;
use ZN\Socket\Exception\SocketAcceptException;
use ZN\Socket\Exception\SocketListenException;

class Server extends SocketExtends implements StructureInterface
{
    use ServerMethods;

    /**
     * Socket accept resource
     * 
     * @var resource
     */
    protected $accept;
    
    /**
     * Backlog
     * 
     * @var int
     */
    protected $backlog = 3;

    /**
     * Backlog
     * 
     * @param int $backlog
     * 
     * @return self
     */
    public function backlog(Int $backlog) : self
    {
        $this->backlog = $backlog;

        return $this;
    } 

    /**
     * Constructor.
     */
    public function __construct($host, $port, $domain, $config)
    {
        $this->extractConfig($config);

        $socket = $this->createSocketResource('tcp', SOCK_STREAM, $domain);

        if( ! socket_bind($socket, $host, $port) )
        {
            throw new SocketBindException(NULL, $this->getLastError());
        }

        if( ! socket_listen($socket, $this->backlog) )
        {
            throw new SocketListenException(NULL, $this->getLastError());
        }

        if( ! $accept = socket_accept($socket) )
        {
            throw new SocketAcceptException(NULL, $this->getLastError());
        }

        $this->socket = $socket; $this->accept = $accept;
    }

    /**
     * Read
     * 
     * @param int $length = 1024
     * @param int $type   = PHP_BINARY_READ - options[PHP_BINARY_READ|PHP_NORMAL_READ]
     */
    public function read(Int $length = 1024, Int $type = PHP_BINARY_READ)
    {
        return socket_read($this->accept, $length, $type);
    }

    /**
     * Write
     * 
     * @param string $content
     */
    public function write(String $content)
    {
        return socket_write($this->accept, $content, strlen($content));
    }

    /**
     * Close socket
     */
    public function close()
    {
        socket_close($this->accept); socket_close($this->socket);
    }
}