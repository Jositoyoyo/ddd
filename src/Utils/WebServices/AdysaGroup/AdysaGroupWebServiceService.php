<?php

namespace App\Utils\WebServices\AdysaGroup;

class AdysaGroupWebServiceService extends \SoapClient {

    /**
     * @var array $classmap The defined classes
     */
    private static $classmap = array(
        'array' => '\\arrayCustom',
        'mixed' => '\\mixed',
        'SearchResult' => '\\SearchResult',
        'SearchResult_array' => '\\SearchResult_array',
    );

    /**
     * @param array $options A array of config values
     * @param string $wsdl The wsdl file to use
     */
    public function __construct(array $options = array(), $wsdl = null) {
        
        $options = array_merge(array(
            'features' => 1,
                ), $options);
        if (!$wsdl) {
            $wsdl = 'https://ondemand.geanetondemand.com/SRV_AGROUP/AdysaGroupWebService.php?wsdl';
        }
        parent::__construct($wsdl, $options);
    }

    /**
     * @param string $searchterms
     * @return SearchResult_array
     */
    public function search($searchterms) {
        return $this->__soapCall('search', array($searchterms));
    }

    /**
     * @param string $msg
     * @return string
     */
    public function publicTest($msg) {
        return $this->__soapCall('publicTest', array($msg));
    }

    /**
     * @param string $msg
     * @return string
     */
    public function privateTest($msg) {
        return $this->__soapCall('privateTest', array($msg));
    }

    /**
     * @param string $sessionid
     * @param string $msg
     * @return string
     */
    public function NHprivateTest($sessionid, $msg) {
        return $this->__soapCall('NHprivateTest', array($sessionid, $msg));
    }

    /**
     * @param string $userid
     * @param string $password
     * @return string
     */
    public function GPWSloginUser($userid, $password) {
        return $this->__soapCall('GPWSloginUser', array($userid, $password));
    }

    /**
     * @param string $userid
     * @param string $password
     * @return string
     */
    public function GNWSserviceAuth($userid, $password) {
        return $this->__soapCall('GNWSserviceAuth', array($userid, $password));
    }

    /**
     * @param string $sessionid
     * @return boolean
     */
    public function checkUserSession($sessionid) {
        return $this->__soapCall('checkUserSession', array($sessionid));
    }

    /**
     * @param string $sessionid
     * @return boolean
     */
    public function GNWScheckSession($sessionid) {
        return $this->__soapCall('GNWScheckSession', array($sessionid));
    }

    /**
     * @param string $sessionid
     * @return boolean
     */
    public function GNWScheckSessionHeader($sessionid) {
        return $this->__soapCall('GNWScheckSessionHeader', array($sessionid));
    }

}
