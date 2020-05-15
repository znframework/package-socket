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

use ZN\Socket\Exception\InvalidProtocolException;

class FactoryExtends
{ 
    /**
     * Other configurations
     * 
     * @var array
     */
    protected static $config = [];

    /**
     * Available protocols
     */
    protected static $protocols = ['tcp', 'udp', 'ssl', 'tls'];

    /**
     * protected connection
     */
    protected static function connection($type, $protocol, $host, $port, $exparam)
    {
        if( ! in_array($protocol, self::$protocols)  )
        {
            throw new InvalidProtocolException(NULL, implode(', ', self::$protocols));
        }

        $class = 'ZN\\Socket\\' . strtoupper($protocol) . '\\' . $type;

        return new $class($host, $port, $exparam, self::$config);
    }
}
