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

use ZN\Socket\Exception\SocketAcceptException;
use ZN\Socket\Exception\SocketConnectException;
use ZN\Socket\Exception\InvalidCrytoMethodException;

trait SSLServerMethods
{   
    use ServerMethods;
    
    /**
     * Socket accept resource
     * 
     * @var resource
     */
    protected $accept;

    /**
     * Constructor.
     */
    public function __construct($host, $port, $timeout, $config)
    {
        $this->extractConfig($config);

        $type = $this->type;

        $socket = stream_socket_server
        (
            "$type://$host:$port", 
            $errno, 
            $errstr, 
            STREAM_SERVER_BIND|STREAM_SERVER_LISTEN,
            stream_context_create(['ssl' => $this->options])
        );

        if( $errstr )
        {
            throw new SocketConnectException(NULL, $errstr);
        }

        if( ! $accept = stream_socket_accept($socket, $timeout ?? ini_get("default_socket_timeout")) )
        {
            throw new SocketAcceptException(NULL, $errstr);
        }

        $this->socket = $socket; $this->accept = $accept;
    }
    
    /**
     * Crypto
     * 
     * @param string $method
     */
    public function crypto(String $method = NULL)
    {
        if( $method === NULL )
        {
            stream_socket_enable_crypto($this->accept, false);
        }
        else
        {
            $algos = 
            [
                'sslv2'   => STREAM_CRYPTO_METHOD_SSLv2_SERVER,
                'sslv3'   => STREAM_CRYPTO_METHOD_SSLv3_SERVER,
                'sslv23'  => STREAM_CRYPTO_METHOD_SSLv23_SERVER,
                'any'     => STREAM_CRYPTO_METHOD_ANY_SERVER,
                'tls'     => STREAM_CRYPTO_METHOD_TLS_SERVER,
                'tlsv1.0' => STREAM_CRYPTO_METHOD_TLSv1_0_SERVER,
                'tlsv1.1' => STREAM_CRYPTO_METHOD_TLSv1_1_SERVER,
                'tlsv1.2' => STREAM_CRYPTO_METHOD_TLSv1_2_SERVER
            ];

            if( ! isset($algos[$method]) )
            {
                throw new InvalidCrytoMethodException(NULL, $this->invalidTypes($algos));
            }
            
            stream_socket_enable_crypto($this->accept, true, $algos[$method]);
        }

        return $this;
    }

    /**
     * Stream set blocking
     * 
     * @param bool $mode = true
     */
    public function blocking(Bool $mode = true)
    {
        stream_set_blocking($this->accept, $mode);

        return $this;
    }

    /**
     * Timeout
     * 
     * @param float $timeout
     * 
     * @return self
     */
    public function timeout(Float $timeout)
    {
        stream_set_timeout($this->accept, $timeout);

        return $this;
    }

    /**
     * Read
     * 
     * @param int $length = 1024
     */
    public function read(Int $length = 1024)
    {
        return fread($this->socket, $length);
    }

    /**
     * Write
     * 
     * @param string $content
     */
    public function write(String $content)
    {
        return fwrite($this->socket, $content, strlen($content));
    }

    /**
     * Close socket
     */
    public function close()
    {
        fclose($this->socket); fclose($this->accept);
    }
}