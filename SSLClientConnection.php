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

class SSLClientConnection extends ConnectionExtends implements ConnectionInterface, SSLInterface
{   
    use SSLClientMethods;

    protected $type = 'ssl';
}