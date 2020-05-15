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

use ZN\Socket\Exception\InvalidDomainException;

class SocketExtends extends ParentExtends
{   
    /**
     * Available domains
     * 
     * @var array
     */
    protected $domains = 
    [
        'v4'   => AF_INET,
        'v6'   => AF_INET6,
        'unix' => AF_UNIX
    ];

    /**
     * protected create socket resource
     */
    protected function createSocketResource($protocol, $type, $domain)
    {
        $domain = $domain ?? 'v4';

        $protocol = getprotobyname($protocol);

        if( ! isset($this->domains[$domain]) )
        {
            throw new InvalidDomainException(NULL, $this->invalidTypes($this->domains));
        }

        return socket_create($this->domains[$domain], $type, $protocol);
    }

    /**
     * protected get last error
     */
    protected function getLastError()
    {
        return socket_last_error();
    }
}
