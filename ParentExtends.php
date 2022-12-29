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

class ParentExtends
{   
    /**
     * Socket resource
     * 
     * @var resource
     */
    protected $socket;

    /**
     * Magic set
     * 
     * @param string $property
     * @param mixed  $value
     * 
     * @return void
     */
    protected function __set($property, $value)
    {
        $this->$property = $value;
    }

    /**
     * protected invalid types
     */
    protected function invalidTypes($types)
    {
        return implode(', ', array_keys($types));
    }

    /**
     * protected extract config
     */
    protected function extractConfig($config)
    {
        foreach( $config as $methods )
        {
            $method     = $methods[0];
            $parameters = $methods[1];

            $this->$method(...$parameters);
        }
    }
}
