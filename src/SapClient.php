<?php
namespace shayand\sapClient;

use shayand\sapClient\Exception\APIResponseConnectException;
use shayand\sapClient\Exception\APIResponseException;
use shayand\sapClient\Exception\UnAuthenticatedException;
use SoapClient;
use SoapFault;

/**
 * Class SapClient
 * @package shayand\sapClient
 */
class SapClient implements iSapClient
{

    /**
     * @var string
     */
    private $username;

    /**
     * @var string
     */
    private $password;

    /**
     * @var SoapClient
     */
    private $soap_client;

    /**
     * @var string
     */
    private $wsdl_url;


    /**
     * GuzzleSapClient constructor.
     * @param string $wsdl_url
     * @param string $username
     * @param string $password
     */
    public function __construct(string $wsdl_url, string $username, string $password)
    {
        ini_set('default_socket_timeout', 500000);

        $this->username = $username;
        $this->password = $password;
        $this->wsdl_url = $wsdl_url;
    }

    /**
     * This function check whether the combination of $national_code, $phone_number exist in business one or not
     *
     * it returns true if user exists
     * and returns false if user doesnt exist in business one
     *
     * @param string $national_code
     * @param string $phone_number
     * @return mixed
     * @throws APIResponseConnectException
     * @throws APIResponseException
     */
    function checkBusinessPartner(string $national_code, string $phone_number)
    {
        $params = [
            'username' => $this->username,
            'password' => $this->password,
            'nationalCode' => $national_code,
            'phoneNumber' => $phone_number
        ];

        $result = $this->getSoapClient()->CheckBusinessPartner($params)->CheckBusinessPartnerResult;
        $status = $result->string[0];
        $message = $result->string[1];


        if ($result == 'Businees Partner Found.' & $status != 404) {
            return true;
        }
        else {
            return false;
        }
    }

    /**
     * @param string $full_name
     * @param string $mobile
     * @param string $national_code
     * @param string $email
     * @param int $is_lid
     * @return string business partner unique identifier on sap on success
     * @throws APIResponseConnectException
     */
    function createBusinessPartner(
        string $mobile,
        string $national_code = null,
        string $full_name = null,
        string $email = null,
        int $is_lid = 0,
        array $profile_data = [],
        array $delivery_data = []
    )
    {
        $params = [
            'username' => $this->username,
            'password' => $this->password,
            'fullName' => $full_name,
            'nationalCode' => $national_code,
            'mobile' => $mobile,
            'isLid' => $is_lid,
            'CurrentAddressIndex' => '1'
        ];
        if($email == null){
            $params['email'] = 'null';
        }
        if(isset($profile_data['BirthDay'])){
            $params['BirthDay'] = $profile_data['BirthDay'];
        }
        if(isset($profile_data['BCity'])){
            $params['BCity'] = $profile_data['BCity'];
        }
        if(isset($profile_data['BBlock'])){
            $params['BBlock'] = $profile_data['BBlock'];
        }
        if(isset($profile_data['BStreet'])){
            $params['BStreet'] = $profile_data['BAddress'];
        }
        if(isset($profile_data['BAddress'])){
            $params['BAddress'] = $profile_data['BBlock'];
        }
        if(isset($profile_data['BAddress2'])){
            $params['BAddress2'] = $profile_data['BAddress2'];
        }
        if(isset($profile_data['BAddress3'])){
            $params['BAddress3'] = $profile_data['BAddress3'];
        }
        if(isset($profile_data['BZipCode'])){
            $params['BZipCode'] = $profile_data['BZipCode'];
        }
        if(isset($delivery_data['DCity'])){
            $params['DCity'] = $delivery_data['DCity'];
        }
        if(isset($delivery_data['DBlock'])){
            $params['DBlock'] = $delivery_data['DBlock'];
        }
        if(isset($delivery_data['DStreet'])){
            $params['DStreet'] = $delivery_data['DAddress'];
        }
        if(isset($delivery_data['DAddress'])){
            $params['DAddress'] = $delivery_data['DBlock'];
        }
        if(isset($delivery_data['DAddress2'])){
            $params['DAddress2'] = $delivery_data['DAddress2'];
        }
        if(isset($delivery_data['DAddress3'])){
            $params['DAddress3'] = $delivery_data['DAddress3'];
        }
        if(isset($delivery_data['DZipCode'])){
            $params['DZipCode'] = $delivery_data['DZipCode'];
        }

        try {
            $result = $this->getSoapClient()->CreateBusinessPartner($params)->CreateBusinessPartnerResult;

            if(isset($result->string)){

                $status = $result->string[0];
                $message = $result->string[1];

                if($status == '201') {
                    $sap_id = explode(':', $message);
                    return $sap_id[1];
                }else{
                    throw new APIResponseException($result);
                }
            }
        }
        catch (\Exception $e) {
            if(get_class($e) == 'SoapFault' && $e->getMessage() == 'Could not connect to host' ) {
                throw new APIResponseConnectException(
                    sprintf('Exception Class : %s, Exception Message : %s', get_class($e), $e->getMessage())
                );
            }
            throw $e;
        }
    }

    /**
     * @param string $mobile
     * @param string $national_code
     * @param string $full_name
     * @param string $email
     * @param int $is_lid
     * @param int $have_access
     * @return mixed
     * @throws APIResponseConnectException
     * @throws APIResponseException
     * @throws UnAuthenticatedException
     */
    function updateBusinessPartner(
        string $mobile,
        string $national_code,
        string $full_name = null,
        string $email = null,
        int $is_lid = 0,
        int $have_access = 0
    )
    {
        $params = [
            'username' => $this->username,
            'password' => $this->password,
            'nationalCode' => $national_code,
            'mobile' => $mobile,
            'fullName' => $full_name,
            'Email' => $email,
            'isLid' => $is_lid,
            'haveAccess' => $have_access
        ];
        if($email == null){
            $params['email'] = 'null';
        }

        $result = $this->getSoapClient()->UpdateBusinessPartner($params)->UpdateBusinessPartnerResult;

        $status = $result->string[0];
        $message = $result->string[1];

        if($message == "Business Partner Successfully Updated.") {
            ## success update
            return true;
        }

        ### unauthenticated user
        elseif($message == 'IS Not Valid User') {
            throw new UnAuthenticatedException;
        } else {
            ## not success
            return false;
        }
    }

    /**
     * @return bool
     * @throws APIResponseConnectException
     * @throws APIResponseException
     */
    function healthCheck()
    {
        $params = ['username' => $this->username, 'password' => $this->password];

        $result = $this->getSoapClient()->HealthCheck($params)->HealthCheckResult;
        $status = $result->string[0];
        $message = $result->string[1];

        if($message == 'Invalid WSUsername and WSPassword.') {
            throw new UnAuthenticatedException;
        }

        return ($message != -1  & $status == 200) ? true: false;
    }


    /**
     * @return SoapClient
     * @throws APIResponseException
     * @throws ApiResponseConnectException
     */
    private function getSoapClient()
    {
        if(! is_null($this->soap_client)) {
            return $this->soap_client;
        }

        try{
            $this->soap_client = new SoapClient(
                $this->wsdl_url,
                ['exception' => true, 'trace' => 1 , 'keep_alive' => false , 'connection_timeout' => '500000', 'encoding' => 'UTF-8']
            );

            return $this->soap_client;
        }

        catch (\Exception $e) {

            if (
                get_class($e) == SoapFault::class &&
                strpos($e->getMessage(), "SOAP-ERROR: Parsing WSDL: Couldn't load from") !== false
            ) {
                throw new ApiResponseConnectException(
                    sprintf("Invalid Soap Server
                    Exception Class : %s , 
                    Exception Message is : %s", get_class($e), $e->getMessage())
                );
            }


            else {
                throw new APIResponseException(
                    sprintf("Exception Class : %s , Exception Message is : %s", get_class($e), $e->getMessage())
                );
            }
        }

    }

    /**
     * @param string $mobile
     * @return BusinessPartnerEntity
     * @throws APIResponseConnectException
     * @throws APIResponseException
     */
    function getBusinessPartnerByMobile(string $mobile)
    {
        $params = ['username' => $this->username, 'password' => $this->password, 'Cellular' => $mobile];

        $result = $this->getSoapClient()->GetBPByCellular($params)->GetBPByCellularResult;
        return $this->extractBPFromXml($result);
    }

    /**
     * @param string $national_code
     * @return BusinessPartnerEntity
     * @throws APIResponseConnectException
     * @throws APIResponseException
     */
    function getBusinessPartnerByNationalCode(string $national_code)
    {
        $params = ['username' => $this->username, 'password' => $this->password, 'NationalId' => $national_code];

        $result = $this->getSoapClient()->GetBPByNationalCode($params)->GetBPByNationalCodeResult;
        return $this->extractBPFromXml($result);
    }

    /**
     * @param string $sap_identifier
     * @return BusinessPartnerEntity
     * @throws APIResponseConnectException
     * @throws APIResponseException
     */
    function getBusinessPartnerByBPSapIdentifier(string $sap_identifier)
    {
        $params = ['username' => $this->username, 'password' => $this->password, 'CardCode' => $sap_identifier];

        $result = $this->getSoapClient()->GetBPByCardCode($params)->GetBPByCardCodeResult;
        return $this->extractBPFromXml($result);    }

    /**
     * @param $string
     * @param $start
     * @param $end
     * @return false|string
     */
    function get_string_between($string, $start, $end){
        $string = ' ' . $string;
        $ini = strpos($string, $start);
        if ($ini == 0) return '';
        $ini += strlen($start);
        $len = strpos($string, $end, $ini) - $ini;
        return substr($string, $ini, $len);
    }

    /**
     * @param string $xml
     * @return BusinessPartnerEntity
     */
    private function extractBPFromXml(string $xml)
    {
        $full_name = $this->get_string_between($xml, '<CardName>', '</CardName>');
        $sap_id = $this->get_string_between($xml, '<CardCode>', '</CardCode>');
        $mobile = $this->get_string_between($xml, '<Cellular>', '</Cellular>');
        $email = $this->get_string_between($xml, '<E_Mail>', '</E_Mail>');
        $country = $this->get_string_between($xml, '<Country>', '</Country>');
        $national_code = $this->get_string_between($xml, '<AddID>', '</AddID>');

        return (new BusinessPartnerEntity())
            ->setSapId($sap_id)
            ->setFullName($full_name)
            ->setNationalCode($national_code)
            ->setMobile($mobile)
            ->setEmail($email)
            ->setCountry($country);
    }

    /**
     * @param InsuranceCertificate $certificate
     * @return mixed
     * @throws APIResponseConnectException
     * @throws APIResponseException
     */
    public function registerInsurrance(
        InsuranceCertificate $certificate
    )
    {
        $send_array = $certificate->toArray();
        $send_array['username'] = $this->username;
        $send_array['password'] = $this->password;
        $result = $this->getSoapClient()->RegInsuranceCertificate($send_array)->RegInsuranceCertificateResult;

        if(strpos($result, 'Certificate Registered Successfuly.Document Number') !== false ) {
            return $result = explode(':', $result)[1];
        }else{
            throw new APIResponseException($result);
        }
    }
}
