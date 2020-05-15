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
use ZN\Socket\Exception\InvalidProtocolException;

class ConnectionExtends
{   
    /**
     * Socket resource
     * 
     * @var resource
     */
    protected $socket;

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
     * Timeout
     * 
     * @var float
     */
    protected $timeout;

    /**
     * Context options
     * 
     * @var array
     */
    protected $options = [];

    /**
     * SSL context options
     * 
     * @var array
     */
    protected $sslContextOptions = 
    [
        'peerName'              => 'peer_name',
        'verifyPeer'            => 'verify_peer',
        'verifyPeerName'        => 'verify_peer_name',
        'allowSelfSigned'       => 'allow_self_signed',
        'ca'                    => 'cafile',
        'capath'                => 'capath',
        'cert'                  => 'local_cert',
        'pk'                    => 'local_pk',
        'passphrase'            => 'passphrase',
        'commonNameMatch'       => 'CN_match',
        'verifyDepth'           => 'verify_depth',  
        'ciphers'               => 'ciphers',
        'capturePeerCert'       => 'capture_peer_cert',
        'capturePeerCertChain'  => 'capture_peer_cert_chain',
        'sniEnable'             => 'SNI_enable',
        'sniServerName'         => 'SNI_server_name',
        'disableCompression'    => 'disable_compression',
        'peerFingerprint'       => 'peer_fingerprint'
    ];

    /**
     * Timeout
     * 
     * @param float $timeout
     * 
     * @return self
     */
    public function timeout(Float $timeout)
    {
        $this->timeout = $timeout;

        return $this;
    }

    /**
     * Timeout
     * 
     * @param string $name
     * @param mixed  $value
     * 
     * @return self
     */
    public function option(String $name, $value)
    {
        $this->options[$this->sslContextOptions[$name] ?? $name] = $value;

        return $this;
    }

    /**
     * Live
     * 
     * @param callback $callback
     */
    public function live($callback)
    {
        while( true )
        {
            $callback($this);
        }
    }

    /**
     * Wait
     * 
     * @param int $seconds
     */
    public function wait(Int $seconds)
    {
        sleep($seconds);
    }

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
