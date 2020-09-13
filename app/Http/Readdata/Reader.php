<?php
/**
 * Created by PhpStorm.
 * User: javad
 * Date: 9/11/20
 * Time: 10:13 PM
 */

namespace App\Http\Readdata;


use App\Http\Api\ApiSourceInterface;

abstract class Reader implements interfaceReader
{
    protected $api;
    protected $attachments;
    protected $key;

    public function __construct(ApiSourceInterface $api, $attachments = null, $key = null)
    {
        $this->api = $api;
        $this->attachments = $attachments;
        $this->key = $key;
    }


    public abstract function read();
}