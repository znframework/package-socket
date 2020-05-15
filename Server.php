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

class Server extends SocketExtends implements ServerInterface
{
    use SocketStaticCaller;

    /**
     * Run
     * 
     * @param string $protocol
     * @param string $host
     * @param int    $port
     * @param mixed  $exparam = NULL
     */
    public static function run(String $protocol, String $host, Int $port, $exparam = NULL)
    {   
        return self::connection('Server', $protocol, $host, $port, $exparam);
    }
}