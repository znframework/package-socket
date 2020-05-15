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

class TLSClientConnection extends StreamExtends implements StructureInterface, StreamInterface
{   
    use SSLClientMethods;
    
    protected $type = 'tls';
}