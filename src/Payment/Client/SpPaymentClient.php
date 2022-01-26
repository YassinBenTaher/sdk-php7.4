<?php


namespace Payment\Client;
use GuzzleHttp\Exception\GuzzleException;
use http\Client;
use Payment\Models\Payment\Domestic\SpCreateDomesticPaymentResponse;
use Payment\Models\Payment\Domestic\SpDomesticPayment;
use Payment\Models\Response\SpareSdkResponse;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;


require_once 'vendor/autoload.php';

class SpPaymentClient implements ISpPaymentClient
{

    public SpPaymentClientOptions $clientOptions;

    function __construct(SpPaymentClientOptions $ClientOptions) {
        $this->clientOptions = $ClientOptions;
    }


    /**
     * @throws GuzzleException
     */
    public function CreateDomesticPayment(SpDomesticPayment $payment, string $signature): SpCreateDomesticPaymentResponse
    {
        $serializer = $this->GetSerializer();
        $client = new \GuzzleHttp\Client();
        $headers = array('app-id' => $this->clientOptions->appId,
            'x-api-key' => $this->clientOptions->appKey,
            'Content-Type' => 'application/json',
            'x-signature' => $signature);
        $request = new \GuzzleHttp\Psr7\Request('POST', $this->GetUrl(SpEndPoints::$CreateDomesticPayment),
            $headers, json_encode($payment));
        $response = $client->send($request);
        $responseData = $serializer->deserialize($response->getBody(), SpareSdkResponse::class, 'json');
        return new SpCreateDomesticPaymentResponse(
            $responseData->getData(),
            $response->getHeaderLine("x-signature")
        );
    }

    /**
     * @throws GuzzleException
     */
    public function GetDomesticPayment(string $id)
    {
        $serializer = $this->GetSerializer();
        $client = new \GuzzleHttp\Client();
        $request = new \GuzzleHttp\Psr7\Request('GET', "{$this->GetUrl(SpEndPoints::$GetDomesticPayment)}?id=$id", $this->GetHeaders());
        $response = $serializer->deserialize($client->send($request)->getBody(), SpareSdkResponse::class, 'json');
        return $response->getData();
    }

    /**
     * @throws GuzzleException
     */
    public function ListDomesticPayment(int $start, int $perPage)
    {
        $serializer = $this->GetSerializer();
        $client = new \GuzzleHttp\Client();
        $request = new \GuzzleHttp\Psr7\Request('GET', "{$this->GetUrl(SpEndPoints::$ListDomesticPayment)}?start=$start&perPage=$perPage" , $this->GetHeaders());
        $response = $serializer->deserialize($client->send($request)->getBody(), SpareSdkResponse::class, 'json');
        return $response->getData();
    }

    private function GetUrl($endpoint): string {
        return "{$this->clientOptions->baseUrl}{$endpoint}";
    }

    private function GetHeaders(): array {
        return array('app-id' => $this->clientOptions->appId,
            'x-api-key' => $this->clientOptions->appKey,
            'Content-Type' => 'application/json');
    }

    private function GetSerializer(): Serializer
    {
        $encoders = [new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()];
        return new Serializer($normalizers, $encoders);
    }


}