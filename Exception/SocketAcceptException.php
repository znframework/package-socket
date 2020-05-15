<?php namespace ZN\Socket\Exception;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

use ZN\Ability\Exclusion;

class SocketAcceptException extends  \InvalidArgumentException
{
    use Exclusion;

    const lang = 
    [
        'en' => 'Could not accept incoming connection! [%]',
        'tr' => 'Gelen bağlantı kabul edilemedi! [%]'
    ];
}
