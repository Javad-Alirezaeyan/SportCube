<?php
/**
 * Created by PhpStorm.
 * User: javad
 * Date: 9/9/20
 * Time: 12:26 PM
 */

namespace App\Http\Readdata;


use App\Http\Api\ApiSourceInterface;

class BuildMatch
{
    const ATTACH_COMPETITION = "matches.competition";
    const PRE_STATES = "PRE";
    const DATE_FORMAT = "Y-m-d\TH:i:s\Z";
    const MATCH_URL = '/v3/de_DE/42/matches';

    /**
     * @var ApiSourceInterface 
     */
    private $api;
    /**
     * @var string
     */
    private $url;
    /**
     * @var string
     */
    private $intervalType;
    /**
     * @var array
     */
    private $matches = [];
    /**
     * @var string
     */
    protected $upDate;


    public function __construct(ApiSourceInterface $api, $interval_type =DAILY_Interval)
    {
        $this->api = $api;
        $this->intervalType = $interval_type;
    }

    /**
     * @param $upDate
     * @return array
     */
    public function run($upDate)
    {
       $this->url = self::MATCH_URL. '?' . http_build_query([
               'states' => self::PRE_STATES,
               'matchdate_to' => $upDate->format(self::DATE_FORMAT),
               'attach' => self::ATTACH_COMPETITION,
           ]);
       $this->collectMatch();
       return  $this->groupData();
    }


    /**
     * @return array
     */
    private function groupData(): array
    {
        return (new MatchesCollector())->collect($this->matches, $this->intervalType);
    }


    /**
     * this method is a recursive function that find information about matches. In each call it retrieve the one page of matches
     */
    public function collectMatch():void
    {
        $result = $this->api->fetch($this->url);
        $keyMatches = $result['data'];

        if(empty($keyMatches)){
            // if there is not any matches
            return;
        }

        $attachments = isset($result['attachments']) ? $result['attachments'] : null;
        foreach ($keyMatches as $key=>$value){

            $match = new Match($this->api, $attachments, $value);
            //push the match into an array
            array_push($this->matches, $match->read());
        }

        if(!isset($result['pagination']['next'])){
            //if there isn't a next page in the response of API
            return;
        }

        $this->url = $result['pagination']['next'];
        $this->collectMatch();
    }

}