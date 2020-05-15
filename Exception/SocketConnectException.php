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

class SocketConnectException extends  \InvalidArgumentException
{
    use Exclusion;

    const lang = 
    [
        'en' => 'Could not connect to socket! [%]',
        'tr' => 'Sokete bağlanmadı! [%]'
    ];
}
