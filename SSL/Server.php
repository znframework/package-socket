<?php namespace ZN\Socket\SSL;
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
use ZN\Socket\StreamServerMethods;

class Server extends StreamExtends implements StructureInterface, StreamInterface
{   
    use StreamServerMethods;

    protected $type = 'ssl';
}