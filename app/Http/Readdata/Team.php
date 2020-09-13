<?php
/**
 * Created by PhpStorm.
 * User: javad
 * Date: 9/11/20
 * Time: 10:17 PM
 */

namespace App\Http\Readdata;


class Team extends Reader
{
    protected $fullName;
    protected $shortName;
    protected $image;
    const TEAM_URL = 'v3/de_DE/42/teams';

    /**
     * @return array
     * this function returns the information about a team
     */
    public function read()
    {
        if($this->existTeamInAttachment()){
            $team = $this->attachments[$this->key];
        }
        else{
            $team =  $this->fetchFromApi();
        }

        $this->fullName = $team['fullname'];
        $this->shortName = $team['shortname'];
        $this->image = isset($team['imageUrls']['small']) ? $team['imageUrls']['small'] : null ;
        return $this->buildTeam();
    }

    /**
     * @return bool
     * this function checks if there is information about this team in the attachments
     */
    private function existTeamInAttachment()
    {
        return isset($this->attachments[$this->key]) ? true : false;
    }


    /**
     * @return mixed
     */
    private function fetchFromApi()
    {
        // read data from Api
        $result = $this->api->fetch($this->key);
        return $result['data'];
    }

    /**
     * @return array
     */
    private function buildTeam(){
        return[
          'fullName' => $this->fullName,
          'shortName'=> $this->shortName,
          'image' => $this->api->getBaseUrl(). $this->api->buildQuery($this->image)
        ];
    }


}