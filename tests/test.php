<?php
require_once __DIR__ . '/../vendor/autoload.php';
use Helpers\Crypto\SpCrypto;

$client = new \Payment\Client\SpPaymentClient(
    new \Payment\Client\SpPaymentClientOptions('https://devpayment.tryspare.com',
        'uydh6g0gfqvKhcxcVGAWS2V+T+h/8simgnbMFrj/tOw=',
        '9LsJP+tpqhdEQQAs4wJ5EQZKLGeydf9RBt3xsJUs6GI=')
);
/* try {
    $rep = $client->GetDomesticPayment('6383ee82-48f4-4e4f-b254-634467789c94');
    print_r($rep);
} catch (\GuzzleHttp\Exception\GuzzleException $e) {
} */


/* try {
    $list = $client->ListDomesticPayment(0, 10);
    print_r($list);
} catch (\GuzzleHttp\Exception\GuzzleException $e) {
}  */

$serKey = "-----BEGIN PUBLIC KEY-----
MFkwEwYHKoZIzj0CAQYIKoZIzj0DAQcDQgAEZergpIl9cU89g/iV97ZLPSyPc7S3
Z5l3yXTuHXDTOnFwhHr/Pep8UFOl26Gbjxf0I84MjJFsqNsmUSfjdZTr7Q==
-----END PUBLIC KEY-----";

$payment = new \Payment\Models\Payment\Domestic\SpDomesticPayment(
    50.55, 'Test payment'
);
print_r($payment);

$rep = $client->CreateDomesticPayment($payment, 'MEUCIQCcGogWLyj1y3ixDOd+t5Vm6lHqUEFa3DTjFBPwohGjLgIgCR51AGpLfFGLzQ2p5pIyU2BQ7mIzpvu71iTezKU/3So=');
print_r($rep);

$signature = new \Helpers\Security\DigitalSignature\EccSignatureManager();
$ser = new \Helpers\Security\DigitalSignature\serializer();
$data = $ser->Serialise($rep->getPayment());

$ver = $signature->Verify($data, $rep->getSignature(), $serKey);
var_dump($ver);
