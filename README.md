### SAP (Business One) PHP API Client

you can find usage of this library down here,

```php
use shayand\sapClient\SapClient;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


function get_string_between($string, $start, $end){
    $string = ' ' . $string;
    $ini = strpos($string, $start);
    if ($ini == 0) return '';
    $ini += strlen($start);
    $len = strpos($string, $end, $ini) - $ini;
    return substr($string, $ini, $len);
}

require "vendor/autoload.php";

$wsdl_internal = "http://192.168.100.34:8081/CheckPartnerService.asmx?wsdl";
$wsdl_external = "http://81.91.156.134:2275?wsdl";

$username = "Admin";
$password = "Admin";

$sap_client = new SapClient($wsdl_internal, $username, $password);

die();

//var_dump($sap_client->getBusinessPartnerByBPSapIdentifier('C0010702'));
//var_dump($sap_client->getBusinessPartnerByNationalCode('3732981134'));


die();

```

for accessing to local client (SAP Business 1) use below credentials:

````
DB: azki_test
USER: b1i
pass: 1234
````