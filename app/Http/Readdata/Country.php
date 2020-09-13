<?php
/**
 * Created by PhpStorm.
 * User: javad
 * Date: 9/12/20
 * Time: 12:08 PM
 */

namespace App\Http\Readdata;


class Country extends Reader
{

    protected $code;
    protected $iso;
    protected $name;
    protected $pathUrl;

    public function read()
    {
        $this->pathUrl = $this->key;
        $res =  $this->fetchFromApi();
        $data = $res['data'];
        $this->code = $data['code'];
        $this->iso = $data['iso'];
        $this->name = $data['name'];

        return $this->buildCountry();
    }
    private function fetchFromApi()
    {

       return $this->api->fetch($this->pathUrl);
    }

    private function buildCountry(){
        return[
            'code' => $this->code,
            'iso'=> $this->iso,
            'name' => $this->name
        ];
    }

}