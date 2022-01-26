<?php


namespace Payment\Client;


use Http\Promise\Promise;
use Payment\Models\Payment\Domestic\SpCreateDomesticPaymentResponse;
use Payment\Models\Payment\Domestic\SpDomesticPayment;

interface ISpPaymentClient
{
    /**
     * @param SpDomesticPayment $payment
     * @return mixed
     */
    function CreateDomesticPayment(SpDomesticPayment $payment, string $signature);

    /**
     * @param string $id
     * @return mixed
     */
    function GetDomesticPayment(string $id);

    /**
     * @param int $start
     * @param int $perPage
     * @return mixed
     */
    function ListDomesticPayment(int $start, int $perPage);

}