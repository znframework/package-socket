<?php namespace ZN\Socket\TLS;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

use ZN\Socket\StreamExtends;
use ZN\Socket\StreamInterface;
use ZN\Socket\StructureInterface;
use ZN\Socket\StreamClientMethods;

class Client extends StreamExtends implements StructureInterface, StreamInterface
{   
    use StreamClientMethods;
    
    protected $type = 'tls';
}