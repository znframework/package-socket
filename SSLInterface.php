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

interface SSLInterface
{
    /**
     * Crypto
     * 
     * @param string $method
     */
    public function crypto(String $method = NULL);

    /**
     * Stream set blocking
     * 
     * @param bool $mode = true
     */
    public function blocking(Bool $mode = true);

    /**
     * Timeout
     * 
     * @param float $timeout
     * 
     * @return self
     */
    public function timeout(Float $timeout);
}