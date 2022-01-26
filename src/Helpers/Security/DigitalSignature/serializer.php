<?php

namespace Helpers\Security\DigitalSignature;

class serializer
{
    function Serialise(array $payment): string
    {
        ksort($payment);
        return $this->json_encode(array_filter($payment));
    }
    private  function json_encode($value): string
    {
        if (is_int($value)) {
            return (string)$value;
        } elseif (is_float($value)) {
            return str_replace(",", ".", $value);
        } elseif (is_null($value)) {
            return 'null';
        } elseif (is_bool($value)) {
            return $value ? 'true' : 'false';
        } elseif (is_array($value)) {
            $n = count($value);
            for ($i = 0, reset($value); $i < $n; $i++, next($value)) {
                if (key($value) !== $i) {
                    break;
                }
            }
        } elseif (is_object($value)) {
        } else {
            return '';
        }
        $result = array();
        foreach ($value as $key => $v) {
            $result[] = '"'.strval((string)$key).'"'.':'.'"'.strval($v).'"';
        }
        return '{'.implode(',', $result).'}';
    }
}