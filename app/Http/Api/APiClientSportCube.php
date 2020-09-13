<?php
/**
 * Created by PhpStorm.
 * User: javad
 * Date: 9/11/20
 * Time: 9:22 AM
 */

namespace App\Http\Api;


use GuzzleHttp\Client;

class APiClientSportCube implements ApiSourceInterface
{
    const BASE_URL = 'https://api.sports-cube.com';
    const API_KEY = '2noaiLn007jBj14rtOiPkTXBu5x9EK07';


    public function fetch($subUrlPath): array
    {
        try{
            $client = new Client(['base_uri' => self::BASE_URL]);
            $response = $client->request('GET', $this->buildQuery($subUrlPath));
            $body = $response->getBody();
            $content =$body->getContents();
            return json_decode($content,TRUE);
        }
        catch(\Exception $e){
            throw new \Exception("error in getting data of API");
        }
    }

    public function buildQuery($subUrlPath): string
    {
        $url_parts = parse_url($subUrlPath);

        if (isset($url_parts['query'])) {
            parse_str($url_parts['query'], $params);
        } else {
            $params = array();
        }

        $params['apikey'] = self::API_KEY;

        return $url_parts['path']."?" . http_build_query($params);
    }

    public function getBaseUrl(){
        return self::BASE_URL;
    }

}