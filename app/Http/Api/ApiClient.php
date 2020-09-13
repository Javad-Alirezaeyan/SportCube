<?php

namespace App\Http\Api;



abstract class  ApiClient implements ApiSourceInterface
{

    public function __construct()
    {

    }


    public abstract function fetch($url, $option):array;
}