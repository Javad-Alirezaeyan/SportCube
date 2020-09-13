<?php
/**
 * Created by PhpStorm.
 * User: javad
 * Date: 9/9/20
 * Time: 12:24 PM
 */

namespace App\Http\Api;


interface ApiSourceInterface
{
    public  function fetch(string $subUrlPath) : array ;
}