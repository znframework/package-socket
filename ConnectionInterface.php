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

interface ConnectionInterface
{
    /**
     * Read
     * 
     * @param int $length
     */
    public function read(Int $length);

    /**
     * Write
     * 
     * @param string $content
     */
    public function write(String $content);

    /**
     * Close socket
     */
    public function close();
}