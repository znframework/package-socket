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

class StreamExtends extends ParentExtends
{   
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
}
