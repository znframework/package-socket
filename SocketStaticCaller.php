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

trait SocketStaticCaller
{
    /**
     * Call static
     * 
     * @param string $method
     * @param array  $parameters
     * 
     * @return self
     */
    public static function __callStatic($method, $parameters)
    {
        self::$config[] = [$method, $parameters];

        return new self;
    }
}