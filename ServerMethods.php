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

trait ServerMethods
{   
    /**
     * Live
     * 
     * @param callback $callback
     */
    public function live($callback)
    {
        while( true )
        {
            $callback($this);
        }
    }

    /**
     * Wait
     * 
     * @param int $seconds
     */
    public function wait(Int $seconds)
    {
        sleep($seconds);
    }
}