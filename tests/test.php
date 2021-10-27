<?php
require_once __DIR__ . '/../vendor/autoload.php';

$client = new \Payment\Client\SpPaymentClient(
    new \Payment\Client\SpPaymentClientOptions('https://devpayment.tryspare.com',
        'mHzLLIyaKyClbr5WPP8v3mqu1PLHfRqEJfaNkqXt/Og=',
        'deVF3jjcOggbtFJWiRN0M246lBpADD5MVvaowKJlFfg=')
);
 try {
    $rep = $client->GetDomesticPayment('6383ee82-48f4-4e4f-b254-634467789c94');
    print_r($rep);
} catch (\GuzzleHttp\Exception\GuzzleException $e) {
}


/* try {
    $list = $client->ListDomesticPayment(0, 10);
    print_r($list);
} catch (\GuzzleHttp\Exception\GuzzleException $e) {
} */


/* try {
    $rep = $client->CreateDomesticPayment(new \Payment\Models\Payment\Domestic\SpDomesticPayment(
        50, 'Test payment'
    ));
    print_r($rep);
} catch (\GuzzleHttp\Exception\GuzzleException $e) {
} */
