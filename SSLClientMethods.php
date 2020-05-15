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
use ZN\Socket\Exception\InvalidCrytoMethodException;

trait SSLClientMethods
{   
    /**
     * Constructor.
     */
    public function __construct($host, $port, $timeout, $config)
    {
        $this->extractConfig($config);

        $type = $this->type;

        $socket = stream_socket_client
        (
            "$type://$host:$port", 
            $errno, 
            $errstr, 
            $timeout ?? ini_get("default_socket_timeout"),
            STREAM_CLIENT_CONNECT,
            stream_context_create(['ssl' => $this->options])
        );

        if( $errstr )
        {
            throw new SocketConnectException(NULL, $errstr);
        }

        $this->socket = $socket;
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
            stream_socket_enable_crypto($this->socket, false);
        }
        else
        {
            $algos = 
            [
                'sslv2'   => STREAM_CRYPTO_METHOD_SSLv2_CLIENT,
                'sslv3'   => STREAM_CRYPTO_METHOD_SSLv3_CLIENT,
                'sslv23'  => STREAM_CRYPTO_METHOD_SSLv23_CLIENT,
                'any'     => STREAM_CRYPTO_METHOD_ANY_CLIENT,
                'tls'     => STREAM_CRYPTO_METHOD_TLS_CLIENT,
                'tlsv1.0' => STREAM_CRYPTO_METHOD_TLSv1_0_CLIENT,
                'tlsv1.1' => STREAM_CRYPTO_METHOD_TLSv1_1_CLIENT,
                'tlsv1.2' => STREAM_CRYPTO_METHOD_TLSv1_2_CLIENT
            ];

            if( ! isset($algos[$method]) )
            {
                throw new InvalidCrytoMethodException(NULL, $this->invalidTypes($algos));
            }
            
            stream_socket_enable_crypto($this->socket, true, $algos[$method]);
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
        stream_set_blocking($this->socket, $mode);

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
        stream_set_timeout($this->socket, $timeout);

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
        fclose($this->socket);
    }
}