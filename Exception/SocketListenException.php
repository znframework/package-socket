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

class SocketListenException extends  \InvalidArgumentException
{
    use Exclusion;

    const lang = 
    [
        'en' => 'The socket cannot be listened to! [%]',
        'tr' => 'Soket dinlenemiyor! [%]'
    ];
}
