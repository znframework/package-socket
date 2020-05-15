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

class InvalidProtocolException extends  \InvalidArgumentException
{
    use Exclusion;

    const lang = 
    [
        'en' => 'Invalid protocol! Available options:[%]',
        'tr' => 'Geçersiz protocol! Kullanılabilir seçenekler:[%]'
    ];
}
