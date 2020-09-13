<?php

namespace App\Http\Readdata;


class Match extends Reader
{


    public $url;
    protected $matchDate;
    protected $competitions;
    protected $homeTeam;
    protected $awayTeam;
    protected $expires;
    protected $day;
    protected $kickoffTime;
    protected $globalImportance;

    public $matches = [];
    public $upDate;
    private $resultAPi;

    /**
     * @return array
     * this function returns the information about a match
     */
    public function read()
    {
        $match = null;
        if($this->existMatchInAttachment()){
            $match = $this->attachments[$this->key];
        }
        else{
            $match =  $this->fetchFromApi();
        }

        $this->homeTeam =     (new Team($this->api, $this->attachments, $match['teams']['home']))->read();
        $this->awayTeam =     (new Team($this->api, $this->attachments, $match['teams']['away']))->read();
        $this->competitions = (new Competition($this->api, $this->attachments, $match['competition']))->read();
        $this->globalImportance = $this->competitions['globalImportance'];
        $this->matchDate = $match['matchdate'];

        date_default_timezone_set('Europe/Vienna');
        $this->day = date("Y/m/d", strtotime($this->matchDate));
        $this->kickoffTime = date("H:i", strtotime($this->matchDate));
        $this->expires =   $match['expires'];

        return $this->buildMatch();
    }


    /**
     * @return bool
     * this function checks if there is information about this match in the attachments
     */
    private function existMatchInAttachment()
    {
        return isset($this->attachments[$this->key]) ? true : false;
    }


    /**
     * @return mixed
     */
    private function fetchFromApi(){
        // read data from APi
        $result = $this->api->fetch($this->key);
        return $result['data'];
    }

    private function buildMatch(){
        return [
            'homeTeam' => $this->homeTeam,
            'awayTeam' => $this->awayTeam,
            'competitions' => $this->competitions,
            'globalImportance' => $this->globalImportance,
            'matchDate' => $this->matchDate,
            'expires' => $this->expires,
            'day' => $this->day,
            'kickoffTime'=> $this->kickoffTime
        ];
    }

}