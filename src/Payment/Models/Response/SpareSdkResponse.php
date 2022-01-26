<?php


namespace Payment\Models\Response;


class SpareSdkResponse
{
    public  $error;
    public   $data;
    public   $meta;


    /**
     * @return string
     */
    public function getError()
    {
        return $this->error;
    }

    /**
     * @param string $error
     */
    public function setError( $error)
    {
        $this->error = $error;
    }

    /**
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @return mixed
     */
    public function getMeta()
    {
        return $this->meta;
    }

}